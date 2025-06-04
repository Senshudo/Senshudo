<?php

namespace App\Http\Controllers;

use App\Enums\ArticleStatus;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ChannelResource;
use App\Models\Article;
use App\Models\Channel;
use Inertia\Response;

class HomepageController extends Controller
{
    public function __invoke(): Response
    {
        $featuredArticles = Article::with([
            'categories',
            'author',
            'review',
            'media',
        ])
            ->where('is_featured', true)
            ->where('status', ArticleStatus::PUBLISHED)
            ->orderByDesc('id')
            ->limit(6)
            ->get();

        $articles = Article::with([
            'categories',
            'author',
            'review',
            'media',
        ])
            ->whereNotIn('id', $featuredArticles->pluck('id')->toArray())
            ->where('status', ArticleStatus::PUBLISHED)
            ->orderByDesc('id')
            ->paginate(15);

        $liveStream = Channel::query()->where('is_online', true)->inRandomOrder()->first();

        return inertia('index', [
            'featured' => ArticleResource::collection($featuredArticles),
            'articles' => ArticleResource::collection($articles),
            'liveStream' => $liveStream ? ChannelResource::make($liveStream) : null,
        ]);
    }
}
