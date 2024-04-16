<?php

use App\Http\Controllers\SearchController;
use App\Http\Controllers\TwitchWebhookController;
use Illuminate\Support\Facades\Route;

Route::get('search', SearchController::class)->name('search');

Route::post('webhook/twitch', TwitchWebhookController::class)->name('webhook.twitch');
