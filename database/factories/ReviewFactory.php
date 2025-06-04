<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'article_id' => Article::factory()->create()->id,
            'oneliner' => faker()->sentence(),
            'quote' => faker()->sentence(),
            'overall' => faker()->numberBetween(1, 10),
            'graphics' => faker()->numberBetween(1, 10),
            'story' => faker()->numberBetween(1, 10),
            'gameplay' => faker()->numberBetween(1, 10),
        ];
    }
}
