<?php

// @codeCoverageIgnoreStart

declare(strict_types=1);

namespace App\Console\Commands;

use Discord\Discord;
use Discord\Parts\Guild\Guild;
use Discord\WebSockets\Intents;
use Illuminate\Console\Command;
use Psr\Log\NullLogger;

class DiscordLeaveCommand extends Command
{
    protected $signature = 'app:discord:leave';

    protected $description = 'Tell the bot to leave the Discord server.';

    public function handle(): void
    {
        if (! config('services.discord.bot_token')) {
            $this->error('Discord bot token is not set.');

            return;
        }

        $discord = new Discord([
            'token' => config('services.discord.bot_token'),
            'logger' => new NullLogger,
            'intents' => Intents::getDefaultIntents() | Intents::GUILD_MEMBERS | Intents::GUILD_MESSAGES | Intents::GUILD_MESSAGE_REACTIONS | Intents::GUILD_SCHEDULED_EVENTS | Intents::GUILD_MESSAGE_POLLS,
        ]);

        $discord->once('init', function (Discord $discord): void {
            /** @var Guild|null $guild */
            $guild = $discord->guilds->find(fn (Guild $guild): bool => $guild->id === config('services.discord.server_id'));

            if ($guild) {
                $guild->leave();
            }

            $discord->close();
        });
    }
}

// @codeCoverageIgnoreEnd
