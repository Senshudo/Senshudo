<?php

use Illuminate\Support\Facades\Schedule;
use Spatie\WebhookClient\Models\WebhookCall;

Schedule::command('model:prune', [
    '--model' => [WebhookCall::class],
])->daily();
