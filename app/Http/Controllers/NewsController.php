<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Inertia\Response;

class NewsController extends Controller
{
    public function index(Request $request): Response
    {
        $articles = Article::with([
            'categories',
            'author',
            'review',
            'media',
        ])
            ->orderByDesc('id')
            ->paginate($request->query('perPage', 17));

        return inertia('news/index', [
            'articles' => ArticleResource::collection($articles),
        ]);
    }

    public function show(Article $article): Response
    {
        return inertia('news/view', [
            'article' => ArticleResource::make($article->load([
                'categories',
                'author',
                'review',
                'media',
            ])),
        ]);
    }
}
