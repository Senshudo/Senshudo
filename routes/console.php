<?php

use Illuminate\Support\Facades\Schedule;
use Spatie\WebhookClient\Models\WebhookCall;

Schedule::command('model:prune', [
    '--model' => [WebhookCall::class],
])->weekly();

Schedule::command('app:generate-sitemap')->weeklyOn(1);
