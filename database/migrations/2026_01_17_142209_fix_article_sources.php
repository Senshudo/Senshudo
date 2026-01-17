<?php

declare(strict_types=1);

use App\Models\Article;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Collection;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Article::query()->chunk(200, function (Collection $articles): void {
            $articles->each(function (Article $article): void {
                if (is_string($article->sources)) {
                    $decoded = json_decode($article->sources, true);

                    if (is_array($decoded)) {
                        $article->sources = $decoded;
                        $article->saveQuietly();
                    }
                }
            });
        });
    }
};
