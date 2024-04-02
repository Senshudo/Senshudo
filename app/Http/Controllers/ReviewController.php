<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Inertia\Response;

class ReviewController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $articles = Article::with([
            'categories',
            'author',
            'review',
            'media',
        ])
            ->whereHas('review')
            ->orderByDesc('id')
            ->paginate($request->query('perPage', 17));

        return inertia('news/index', [
            'articles' => ArticleResource::collection($articles),
        ]);
    }
}
