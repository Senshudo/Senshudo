<?php

namespace Database\Seeders;

use App\Enums\ArticleStatus;
use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use App\Models\Event;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OldDatabaseMigrationSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $authors = DB::connection('mysql_old')->table('team')->get();

        foreach ($authors as $author) {
            Author::query()->create([
                'name' => $author->name,
                'slug' => $author->url,
                'is_active' => $author->active,
                'position' => $author->position,
                'twitter' => $author->twitter,
            ]);
        }

        $events = DB::connection('mysql_old')->table('events')->get();

        foreach ($events as $event) {
            Event::query()->create([
                'name' => $event->title,
                'slug' => $event->url,
                'hashtag' => $event->hashtag,
                'website' => $event->website,
                'description' => $event->description,
                'keywords' => $event->keywords,
                'start_date' => Carbon::parse($event->start_date),
                'end_date' => Carbon::parse($event->end_date),
            ]);
        }

        $categories = DB::connection('mysql_old')->table('categories')->get();

        foreach ($categories as $category) {
            Category::query()->create([
                'name' => $category->title,
                'slug' => $category->url,
                'is_parent' => (bool) $category->parent,
                'parent_id' => $category->parent_id,
            ]);
        }

        $articles = DB::connection('mysql_old')
            ->table('articles')
            ->orderBy('articles.id')
            ->leftJoin('reviews', 'articles.id', '=', 'reviews.article_id')
            ->leftJoin('team', 'articles.author_id', '=', 'team.user_id')
            ->leftJoin('events', 'articles.event_id', '=', 'events.id')
            ->select([
                'articles.id as id',
                'articles.title as title',
                'articles.url as slug',
                'articles.excerpt as excerpt',
                'articles.article as content',
                'articles.sources as sources',
                'articles.keywords as keywords',
                'articles.thumbnail as thumbnail',
                'articles.background as background',
                'articles.featured as is_featured',
                'articles.event_id as event_id',
                'articles.categories as categories',
                'articles.published as published_at',
                'articles.modified as updated_at',
                'team.url as author_slug',
                'events.url as event_slug',
                'reviews.oneliner',
                'reviews.quote',
                'reviews.overall',
                'reviews.story',
                'reviews.gameplay',
                'reviews.graphics',
            ])
            ->get();

        foreach ($articles as $article) {
            $newArticle = Article::query()->create([
                'author_id' => Author::query()->firstWhere('slug', $article->author_slug)?->id,
                'event_id' => Event::query()->firstWhere('slug', $article->event_slug)?->id,
                'title' => html_entity_decode((string) $article->title),
                'slug' => $article->slug,
                'excerpt' => html_entity_decode((string) $article->excerpt),
                'content' => $article->content,
                'keywords' => $article->keywords,
                'sources' => $article->sources === 'NULL' ? null : $article->sources,
                'is_featured' => (bool) $article->is_featured,
                'status' => ArticleStatus::PUBLISHED,
                'published_at' => Carbon::parse($article->published_at),
                'created_at' => Carbon::parse($article->published_at),
                'updated_at' => $article->updated_at ? Carbon::parse($article->updated_at) : Carbon::parse($article->published_at),
            ]);

            if ($article->categories) {
                collect(explode(',', trim((string) $article->categories)))
                    ->filter()
                    ->each(function ($category) use ($newArticle): void {
                        $newArticle->categories()->attach(Category::query()->find($category)?->id);
                    });
            }

            if ($article->oneliner) {
                Review::query()->create([
                    'article_id' => $newArticle->id,
                    'oneliner' => $article->oneliner,
                    'quote' => $article->quote,
                    'overall' => $article->overall,
                    'story' => $article->story,
                    'gameplay' => $article->gameplay,
                    'graphics' => $article->graphics,
                    'created_at' => Carbon::parse($article->published_at),
                    'updated_at' => $article->updated_at ? Carbon::parse($article->updated_at) : Carbon::parse($article->published_at),
                ]);
            }
        }
    }
}
