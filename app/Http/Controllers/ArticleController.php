<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleController extends Controller
{
    public function index(): JsonResource
    {
        $articles = Article::with([
            'category',
            'author',
            'review',
        ])
            ->orderByDesc('id')
            ->paginate(15);

        return ArticleResource::collection($articles);
    }

    public function show(Article $article): JsonResource
    {
        return ArticleResource::make($article->load([
            'category',
            'author',
            'review',
        ]));
    }
}
