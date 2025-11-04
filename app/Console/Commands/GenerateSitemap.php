<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $articles = Article::with('review')->orderByDesc('id')->get();

        $review = $articles->whereNotNull('review')->first();

        Sitemap::create()
            ->add(
                Url::create(route('home'))
                    ->setLastModificationDate($articles->first()?->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(1)
            )
            ->add(
                Url::create(route('news.index'))
                    ->setLastModificationDate($articles->first()?->created_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.6)
            )
            ->add(
                Url::create(route('reviews'))
                    ->setLastModificationDate($review?->created_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.6)
            )
            ->add($articles)
            ->writeToFile(public_path('sitemap.xml'));
    }
}
