<?php

namespace Database\Factories;

use App\Models\Channel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Channel>
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
