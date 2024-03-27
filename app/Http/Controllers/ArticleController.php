<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleController extends Controller
{
    public function index(Request $request): JsonResource
    {
        $articles = Article::with([
            'categories',
            'author',
            'review',
            'media',
        ])
            ->orderByDesc('id')
            ->paginate($request->query('perPage', 15));

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
