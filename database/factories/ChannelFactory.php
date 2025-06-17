<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Channel>
 */
class ChannelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'twitch_id' => faker()->unique()->numerify('########'),
            'channel_name' => faker()->unique()->userName(),
            'is_online' => faker()->boolean(),
            'online_webhook_id' => faker()->uuid(),
            'offline_webhook_id' => faker()->uuid(),
        ];
    }
}
