<?php

namespace App\Observers;

use App\Enums\ArticleStatus;
use App\Jobs\GenerateSocialThumbnail;
use App\Jobs\ScheduledArticleJob;
use App\Models\Article;

class ArticleObserver
{
    public function creating(Article $article)
    {
        if ($article->status === ArticleStatus::PUBLISHED) {
            $article->published_at = now();
        }

        if ($article->status === ArticleStatus::SCHEDULED) {
            ScheduledArticleJob::dispatch($article)->delay(now()->diffInSeconds($article->scheduled_for));
        }
    }

    public function created(Article $article)
    {
        GenerateSocialThumbnail::dispatch($article);
    }

    public function updated(Article $article)
    {
        if ($article->isDirty('title')) {
            GenerateSocialThumbnail::dispatch($article);
        }

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
