<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create()->id,
            'name' => faker()->name(),
            'slug' => faker()->unique()->slug(),
            'is_active' => faker()->boolean(),
            'position' => faker()->jobTitle(),
            'twitter' => faker()->optional()->userName(),
        ];
    }
}
