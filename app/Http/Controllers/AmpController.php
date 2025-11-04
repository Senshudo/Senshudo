<?php

namespace App\Http\Controllers;

use App\Enums\ArticleStatus;
use App\Models\Article;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class AmpController extends Controller
{
    public function index(): void
    {
        // Login to list articles
    }

    public function show(Article $article): Factory|View
    {
        // TODO: Resolve HTML for AMP version of the article
        // TODO: Include scripts for specific AMP Tags
        // https://amp.dev/documentation/examples/websites/introduction/hello_world/

        if (! user() instanceof User) {
            abort_if($article->status !== ArticleStatus::PUBLISHED, 404);
        }

        $article->load([
            'categories',
            'author',
            'review',
            'media',
        ]);

        return view('amp.article', [
            'article' => $article,
        ]);
    }
}
