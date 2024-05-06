<?php

namespace App\Http\Controllers;

use App\Enums\ArticleStatus;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\AuthorResource;
use App\Models\Author;

class AuthorController extends Controller
{
    public function __invoke(Author $author)
    {
        $author->with([
            'articles' => function ($query) {
                $query->where('articles.status', ArticleStatus::PUBLISHED);
            },
        ]);

        $articles = $author->articles()->orderByDesc('id')->paginate(16);

        return inertia('news/author', [
            'author' => AuthorResource::make($author),
            'articles' => ArticleResource::collection($articles),
        ]);
    }
}
