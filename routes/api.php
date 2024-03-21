<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('articles', ArticleController::class)->only(['index', 'show']);

Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);
