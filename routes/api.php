<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleFeaturedController;
use App\Http\Controllers\ArticleHomepageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TwitchWebhookController;
use Illuminate\Support\Facades\Route;

Route::prefix('articles')->name('articles.')->group(function () {
    Route::get('', [ArticleController::class, 'index'])->name('index');

    Route::get('homepage', ArticleHomepageController::class)->name('homepage');

    Route::get('featured', ArticleFeaturedController::class)->name('featured');

    Route::get('{article:slug}', [ArticleController::class, 'show'])->name('show');
});

Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);

Route::get('search', SearchController::class)->name('search');

Route::post('webhook/twitch', TwitchWebhookController::class)->name('webhook.twitch');
