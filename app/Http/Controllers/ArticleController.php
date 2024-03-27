<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleController extends Controller
{
    public function index(): JsonResource
    {
        $featuredArticles = Article::where('is_featured', true)
            ->orderByDesc('id')
            ->limit(6)
            ->get()
            ->pluck('id');

        $articles = Article::with([
            'categories',
            'author',
            'review',
            'media',
        ])
            ->whereNotIn('id', $featuredArticles->toArray())
            ->orderByDesc('id')
            ->paginate(15);

        return ArticleResource::collection($articles);
    }

    public function show(Article $article): JsonResource
    {
        return ArticleResource::make($article->load([
            'categories',
            'author',
            'review',
            'media',
        ]));
    }
}
