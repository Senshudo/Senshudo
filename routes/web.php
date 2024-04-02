<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomepageController::class)->name('home');

Route::prefix('news')->name('news.')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('/{article}', [NewsController::class, 'show'])->name('show');
});

Route::get('reviews', ReviewController::class)->name('reviews');

Route::get('schedule', ScheduleController::class)->name('schedule');

Route::get('about', AboutController::class)->name('about');
