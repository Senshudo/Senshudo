<?php

namespace App\Observers;

use App\Enums\ArticleApprovalStatus;
use App\Enums\ArticleStatus;
use App\Jobs\DiscordPostJob;
use App\Jobs\ScheduledArticleJob;
use App\Mail\NewArticle;
use App\Mail\RejectedArticle;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ArticleObserver
{
    public function creating(Article $article): void
    {
        if ($article->status === ArticleStatus::PUBLISHED) {
            $article->published_at = now();
        }

        $article->excerpt = trim(substr(strip_tags(html_entity_decode($article->content)), 0, 255));
        $article->content = $this->parseContent($article->content);

        if ($article->status === ArticleStatus::SCHEDULED) {
            ScheduledArticleJob::dispatch($article)->delay((int) now()->diffInSeconds($article->scheduled_for));
        }
    }

    public function created(Article $article): void
    {
        if ($article->status === ArticleStatus::REVIEW) {
            User::query()->where('is_super', true)
                ->get()
                ->each(fn (User $user) => Mail::to($user)->send(new NewArticle($article, $user)));
        }
    }

    public function updating(Article $article): void
    {
        if ($article->isDirty('content')) {
            $article->excerpt = trim(substr(strip_tags(html_entity_decode($article->content)), 0, 255));
            $article->content = $this->parseContent($article->content);
        }

        if ($article->status === ArticleStatus::REVIEW && $article->isDirty('approval_status') && $article->approval_status === ArticleApprovalStatus::REJECTED) {
            $article->approval_status = null;
        }
    }

    public function updated(Article $article): void
    {
        if ($article->isDirty('approval_status') && $article->approval_status === ArticleApprovalStatus::REJECTED) {
            Mail::to($article->authorUser())->send(new RejectedArticle($article, $article->authorUser()));
        }

        if ($article->isDirty('status') && $article->status === ArticleStatus::REVIEW) {
            User::query()
                ->where('is_super', true)
                ->get()
                ->each(fn (User $user) => Mail::to($user)->send(new NewArticle($article, $user)));
        }

        if (
            $article->status !== ArticleStatus::PUBLISHED &&
            $article->approval_status === ArticleApprovalStatus::APPROVED &&
            $article->published_at === null &&
            $article->scheduled_for === null
        ) {
            $article->update([
                'status' => ArticleStatus::PUBLISHED,
                'published_at' => now(),
            ]);

            DiscordPostJob::dispatch($article);
        }

        if (
            $article->status !== ArticleStatus::SCHEDULED &&
            $article->approval_status === ArticleApprovalStatus::APPROVED &&
            $article->published_at === null &&
            $article->scheduled_for !== null
        ) {
            $article->update([
                'status' => ArticleStatus::SCHEDULED,
            ]);

            ScheduledArticleJob::dispatch($article)->delay((int) now()->diffInSeconds($article->scheduled_for));
        }
    }

    private function parseContent(string $content): string
    {
        return preg_replace_callback(
            '/\s*style\s*=\s*([\'"])(.*?)\1/i',
            function (array $matches): string {
                $styles = [];
                preg_match_all('/([\w\-]+)\s*:\s*([^;]+)\s*;?/', $matches[2], $styleMatches, PREG_SET_ORDER);
                foreach ($styleMatches as $style) {
                    $name = strtolower($style[1]);
                    $value = trim($style[2]);
                    if (in_array($name, ['font-weight', 'font-style'])) {
                        $styles[] = sprintf('%s: %s', $name, $value);
                    } elseif ($name === 'font-size') {
                        if (preg_match('/^(\d+(?:\.\d+)?)pt$/i', $value, $sizeMatch) && (float) $sizeMatch[1] > 16) {
                            $styles[] = sprintf('%s: %s', $name, $value);
                        }
                    }
                }

                if ($styles !== []) {
                    return ' style="'.implode('; ', $styles).'"';
                }

                return '';
            },
            $content
        );
    }
}
