<?php

namespace App\Http\Controllers;

use App\Enums\ArticleStatus;
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
            ->where('status', ArticleStatus::PUBLISHED)
            ->orderByDesc('id')
            ->paginate((int) $request->query('perPage', '17'));

        return inertia('news/index', [
            'articles' => ArticleResource::collection($articles),
        ]);
    }

    public function show(Request $request, Article $article): Response
    {
        if (! user() instanceof \App\Models\User) {
            abort_if($article->status !== ArticleStatus::PUBLISHED, 404);
        }

        $article->load([
            'categories',
            'author',
            'review',
            'media',
        ]);

        return inertia('news/view', [
            'article' => ArticleResource::make($article),
        ]);
    }
}
