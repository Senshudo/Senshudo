<?php

namespace App\Console\Commands;

use App\Events\LiveStreamUpdated;
use Illuminate\Console\Command;

class TestWebhookCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-webhook-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        event(new LiveStreamUpdated('senshudo', true));
    }
}
