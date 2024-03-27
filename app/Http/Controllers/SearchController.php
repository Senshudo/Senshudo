<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchController extends Controller
{
    public function __invoke(Request $request): JsonResource
    {
        $articles = Article::search($request->query('query'))
            ->query(fn (Builder $query) => $query->with([
                'categories',
                'author',
                'review',
                'media',
            ]))
            ->orderBy('created_at', 'desc')
            ->get();

        return ArticleResource::collection($articles);
    }
}
