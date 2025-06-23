<?php

namespace App\Jobs;

use App\Enums\ArticleStatus;
use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ScheduledArticleJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Article $article)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->article->update([
            'status' => ArticleStatus::PUBLISHED,
            'scheduled_for' => null,
        ]);

        DiscordPostJob::dispatch($this->article);
    }
}
