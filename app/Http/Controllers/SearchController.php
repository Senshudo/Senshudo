<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchController extends Controller
{
    public function __invoke(): JsonResource
    {
        return new JsonResponse([], 500);

        $articles = Article::with([
            'category',
            'author',
            'review',
        ])
            ->orderByDesc('id')
            ->paginate(15);

        return ArticleResource::collection($articles);
    }
}
