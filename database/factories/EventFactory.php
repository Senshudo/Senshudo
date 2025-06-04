<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => faker()->sentence(3),
            'slug' => faker()->unique()->slug(),
            'hashtag' => faker()->word(),
            'website' => faker()->url(),
            'description' => faker()->paragraph(),
            'keywords' => faker()->words(3, true),
            'start_date' => faker()->dateTimeBetween('now', '+1 year'),
            'end_date' => faker()->dateTimeBetween('+1 year', '+2 years'),
        ];
    }
}
