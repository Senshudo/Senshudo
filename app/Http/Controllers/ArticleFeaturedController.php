<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleFeaturedController extends Controller
{
    public function __invoke(Request $request): JsonResource
    {
        $articles = Article::where('is_featured', true)
            ->with([
                'categories',
                'author',
                'review',
                'media',
            ])
            ->orderByDesc('id')
            ->limit($request->query('limit', 5))
            ->get();

        return ArticleResource::collection($articles);
    }
}
