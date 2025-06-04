<?php

namespace App\Observers;

use App\Enums\ArticleStatus;
use App\Jobs\ScheduledArticleJob;
use App\Mail\NewArticle;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class ArticleObserver
{
    public function creating(Article $article): void
    {
        if ($article->status === ArticleStatus::PUBLISHED) {
            $article->published_at = now();
        }

        $article->excerpt = substr(strip_tags($article->content), 0, 255);

        if ($article->status === ArticleStatus::SCHEDULED) {
            ScheduledArticleJob::dispatch($article)->delay((int) now()->diffInSeconds($article->scheduled_for));
        }
    }

    public function created(Article $article): void
    {
        if ($article->status === ArticleStatus::REVIEW && App::isProduction()) {
            User::query()->where('is_super', true)
                ->get()
                ->each(fn (User $user) => Mail::to($user)->send(new NewArticle($article, $user)));
        }
    }

    public function updating(Article $article): void
    {
        $article->excerpt = substr(strip_tags($article->content), 0, 255);
    }

    public function updated(Article $article): void
    {
        if ($article->isDirty('status') && $article->status === ArticleStatus::PUBLISHED && $article->published_at === null) {
            $article->update([
                'published_at' => now(),
            ]);
        }

        if ($article->isDirty('status') && $article->status === ArticleStatus::SCHEDULED) {
            ScheduledArticleJob::dispatch($article)->delay((int) now()->diffInSeconds($article->scheduled_for));
        }

        if ($article->isDirty('status') && $article->status === ArticleStatus::REVIEW && App::isProduction()) {
            User::query()->where('is_super', true)
                ->get()
                ->each(fn (User $user) => Mail::to($user)->send(new NewArticle($article, $user)));
        }
    }
}
