<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'author_id' => User::factory()->create()->id,
            'event_id' => Event::factory()->create()->id,
            'title' => faker()->sentence(),
            'slug' => faker()->unique()->slug(),
            'excerpt' => faker()->paragraph(),
            'content' => faker()->paragraphs(3, true),
            'keywords' => faker()->words(3, true),
            'sources' => ['https://example.com/source1', 'https://example.com/source2'],
            'is_featured' => faker()->boolean(),
            'status' => faker()->randomElement(['draft', 'review', 'published', 'archived']),
            'published_at' => faker()->dateTimeBetween('-1 year', 'now'),
            'scheduled_for' => faker()->dateTimeBetween('now', '+1 year'),
        ];
    }
}
