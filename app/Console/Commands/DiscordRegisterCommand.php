<?php

// @codeCoverageIgnoreStart

declare(strict_types=1);

namespace App\Console\Commands;

use Discord\Discord;
use Discord\Parts\Guild\Guild;
use Discord\WebSockets\Intents;
use Illuminate\Console\Command;
use Psr\Log\NullLogger;

class DiscordRegisterCommand extends Command
{
    protected $signature = 'app:discord:register';

    protected $description = 'Register the bot with the Discord server.';

    public function handle(): void
    {
        if (! config('services.discord.bot_token') || ! config('services.discord.server_id') || ! config('services.discord.permissions')) {
            $this->error('Discord bot configuration is not set.');

            return;
        }

        $discord = new Discord([
            'token' => config('services.discord.bot_token'),
            'logger' => new NullLogger,
            'dnsConfig' => '1.1.1.1',
            'intents' => Intents::getDefaultIntents() | Intents::GUILD_MEMBERS | Intents::GUILD_MESSAGES | Intents::GUILD_MESSAGE_REACTIONS | Intents::GUILD_SCHEDULED_EVENTS | Intents::GUILD_MESSAGE_POLLS,
        ]);

        $discord->once('init', function (Discord $discord): void {
            /** @var Guild|null $guild */
            $guild = $discord->guilds->find(fn (Guild $guild): bool => $guild->id === config('services.discord.server_id'));

            if (is_null($guild)) {
                $this->info('Invite Link: '.$discord->application->getInviteURLAttribute(config('services.discord.permissions')));
            }

            $discord->close();
        });
    }
}

// @codeCoverageIgnoreEnd
