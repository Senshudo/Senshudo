<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\VideoVerificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', HomepageController::class)->name('home');

Route::prefix('news')->name('news.')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('/{article}', [NewsController::class, 'show'])->name('show');
});

Route::get('author/{author}', AuthorController::class)->name('author');

Route::get('reviews', ReviewController::class)->name('reviews');

Route::get('schedule', ScheduleController::class)->name('schedule');

Route::get('about', AboutController::class)->name('about');

Route::prefix('/embed/video_verification')->name('video_verification.')->group(function () {
    Route::get('/', [VideoVerificationController::class, 'index'])->name('index');
    Route::post('/', [VideoVerificationController::class, 'store'])->name('store');
    Route::get('/{video}', [VideoVerificationController::class, 'show'])->name('show');
});

Route::get('/ajax/video_verify.php', function (Request $request) {
    return redirect()->route('video_verification.index', $request->query(), 301);
});

Route::get('media/{media:uuid}/{filename?}', MediaController::class)->name('media.show');

Route::webhooks('webhooks/twitch', 'twitch');

// Redirect old routes
Route::redirect('/home', '/', 301)->name('home.redirect');
Route::redirect('/main', '/', 301)->name('main.redirect');
Route::redirect('/blog', '/news', 301)->name('blog.redirect');

Route::prefix('games')->name('games.')->group(function () {
    Route::redirect('/', '/', 301)->name('index');
    Route::redirect('/{game}', '/', 301)->name('redirect');
});
