<?php

namespace App\Http\Controllers;

use App\Models\Article;

class AmpController extends Controller
{
    public function index(): void
    {
        // Login to list articles
    }

    public function show(Article $article)
    {
        // TODO: Resolve HTML for AMP version of the article
        // TODO: Include scripts for specific AMP Tags
        // https://amp.dev/documentation/examples/websites/introduction/hello_world/

        return view('amp.article', []);
    }
}
