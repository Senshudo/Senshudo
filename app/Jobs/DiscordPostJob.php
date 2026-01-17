<?php

namespace App\Jobs;

use App\Models\Article;
use Discord\Builders\MessageBuilder;
use Discord\Discord;
use Discord\Parts\Channel\Channel;
use Discord\Parts\Embed\Author;
use Discord\Parts\Embed\Embed;
use Discord\Parts\Guild\Guild;
use Discord\Parts\Part;
use Discord\Parts\User\Member;
use Discord\WebSockets\Intents;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Psr\Log\NullLogger;

class DiscordPostJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Article $article)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->article->load('author');

        $discord = new Discord([
            'token' => config('services.discord.bot_token'),
            'logger' => new NullLogger,
            'dnsConfig' => '1.1.1.1',
            'intents' => Intents::getDefaultIntents(),
        ]);

        $discord->once('init', function (Discord $discord): void {
            $discord
                ->guilds
                ->fetch(config('services.discord.server_id'))
                ->then(function (Part $part) use ($discord): void {
                    /** @var Guild $guild */
                    $guild = $part;

                    $guild
                        ->channels
                        ->fetch(config('services.discord.channels.announcements'), true)
                        ->then(function (Part $part) use ($discord, $guild) {
                            /** @var Channel $channel */
                            $channel = $part;

                            return $guild->members->fetch((string) $this->article->author->discord_user_id, true)
                                ->then(function (Part $part) use ($discord, $channel) {
                                    /** @var Member $member */
                                    $member = $part;

                                    $author = new Author($discord, [
                                        'name' => $member->username,
                                        'icon_url' => $member->getAvatarAttribute(),
                                    ]);

                                    $embed = new Embed($discord)
                                        ->setTitle($this->article->title)
                                        ->setDescription(rtrim(strip_tags(html_entity_decode($this->article->excerpt))).'...')
                                        ->setUrl(route('news.show', $this->article))
                                        ->setColor(0x4B0082) // Indigo color
                                        ->setAuthor($author->name, $author->icon_url, route('author', $this->article->author)) // @phpstan-ignore-line
                                        ->setImage($this->article->getFirstMediaUrl('socialThumbnail'))
                                        ->setTimestamp($this->article->created_at->getTimestamp());

                                    $messageBuilder = MessageBuilder::new()
                                        ->setContent($this->article->title)
                                        ->addEmbed($embed);

                                    return $channel
                                        ->sendMessage($messageBuilder)
                                        ->then(function (Part $part) use ($discord): void {
                                            $discord->close();
                                        })->catch(function ($e): void {
                                            Log::error($e);
                                        });
                                });
                        });
                });
        });

        $discord->run();
    }
}
