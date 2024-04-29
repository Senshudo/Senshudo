<?php

namespace App\Observers;

use App\Enums\ArticleStatus;
use App\Jobs\ScheduledArticleJob;
use App\Models\Article;

class ArticleObserver
{
    public function creating(Article $article)
    {
        if ($article->status === ArticleStatus::PUBLISHED) {
            $article->published_at = now();
        }

        $article->excerpt = substr(strip_tags($article->content), 0, 255);

        if ($article->status === ArticleStatus::SCHEDULED) {
            ScheduledArticleJob::dispatch($article)->delay(now()->diffInSeconds($article->scheduled_for));
        }
    }

    public function updating(Article $article)
    {
        $article->excerpt = substr(strip_tags($article->content), 0, 255);
    }

    public function updated(Article $article)
    {
        if ($article->isDirty('status') && $article->status === ArticleStatus::PUBLISHED && $article->published_at === null) {
            $article->update([
                'published_at' => now(),
            ]);
        }

        if ($article->isDirty('status') && $article->status === ArticleStatus::SCHEDULED) {
            ScheduledArticleJob::dispatch($article)->delay(now()->diffInSeconds($article->scheduled_for));
        }
    }
}
