<?php

namespace App\Console\Commands;

use App\Models\Channel;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RegisterWebhook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:register-webhook';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $channels = [
            'senshudo' => '43242267',
            'rbmartworks' => '224673121',
            'freebirdtv' => '38627505',
        ];

        /*Http::post('https://id.twitch.tv/oauth2/token', [
            'client_id' => config('services.twitch.client_id'),
            'client_secret' => config('services.twitch.client_secret'),
            'grant_type' => 'client_credentials',
            'accept' => 'application/json',
        ]);*/

        collect($channels)
            ->each(function ($twitchId, $channelName) {
                $onlineRequest = Http::baseUrl('https://api.twitch.tv/helix')
                    ->withHeaders([
                        'Client-Id' => config('services.twitch.client_id'),
                        'Authorization' => 'Bearer '.config('services.twitch.token'),
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ])
                    ->post('/eventsub/subscriptions', [
                        'type' => 'stream.online',
                        'version' => '1',
                        'condition' => [
                            'broadcaster_user_id' => $twitchId,
                        ],
                        'transport' => [
                            'method' => 'webhook',
                            'callback' => 'https://senshudo.tv/webhooks/twitch',
                            'secret' => config('services.twitch.webhook_secret'),
                        ],
                    ]);

                Log::info("Online: {$onlineRequest->status()}", $onlineRequest->json());

                if (($status = Arr::get($onlineRequest->json(), 'data.0.status')) !== 'webhook_callback_verification_pending') {
                    throw new \Exception("Online: Failed to register webhook for {$channelName} - {$status}");
                } else {
                    $channel = Channel::firstWhere('twitch_id', $twitchId);

                    $channel->update([
                        'online_webhook_id' => Arr::get($onlineRequest->json(), 'data.0.id'),
                    ]);
                }

                $offlineRequest = Http::baseUrl('https://api.twitch.tv/helix')
                    ->withHeaders([
                        'Client-Id' => config('services.twitch.client_id'),
                        'Authorization' => 'Bearer '.config('services.twitch.token'),
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ])
                    ->post('/eventsub/subscriptions', [
                        'type' => 'stream.offline',
                        'version' => '1',
                        'condition' => [
                            'broadcaster_user_id' => $twitchId,
                        ],
                        'transport' => [
                            'method' => 'webhook',
                            'callback' => 'https://senshudo.tv/webhooks/twitch',
                            'secret' => config('services.twitch.webhook_secret'),
                        ],
                    ]);

                Log::info("Offline: {$offlineRequest->status()}", $offlineRequest->json());

                if (($status = Arr::get($offlineRequest->json(), 'data.0.status')) !== 'webhook_callback_verification_pending') {
                    throw new \Exception("Offline: Failed to register webhook for {$channelName} - {$status}");
                } else {
                    $channel = Channel::firstWhere('twitch_id', $twitchId);

                    $channel->update([
                        'offline_webhook_id' => Arr::get($offlineRequest->json(), 'data.0.id'),
                    ]);
                }
            });
    }
}
