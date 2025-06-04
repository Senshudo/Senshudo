<?php

namespace App\Http\Controllers;

use App\Enums\ArticleStatus;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Response;

class AuthorController extends Controller
{
    public function __invoke(Author $author): Response
    {
        $author->with([
            'articles' => function (Builder $query): void {
                $query->where('articles.status', ArticleStatus::PUBLISHED);
            },
        ]);

        $articles = $author
            ->articles()
            ->with([
                'categories',
                'review',
                'media',
            ])
            ->orderByDesc('id')
            ->paginate(16);

        return inertia('news/author', [
            'author' => AuthorResource::make($author),
            'articles' => ArticleResource::collection($articles),
        ]);
    }
}
