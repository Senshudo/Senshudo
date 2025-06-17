<?php

use function Pest\Laravel\postJson;

it('response to the Twitch Webhook Challenge', function () {
    $challengePayload = [
        'challenge' => 'pogchamp-kappa-360noscope-vohiyo',
        'subscription' => [
            'id' => 'f1c2a387-161a-49f9-a165-0f21d7a4e1c4',
            'status' => 'webhook_callback_verification_pending',
            'type' => 'stream.online',
            'version' => '1',
            'cost' => 1,
            'condition' => [
                'broadcaster_user_id' => '12826',
            ],
            'transport' => [
                'method' => 'webhook',
                'callback' => 'https://example.com/webhooks/callback',
            ],
            'created_at' => '2024-04-18T22:00:00.634234626Z',
        ],
    ];

    $id = 'f1c2a387-161a-49f9-a165-0f21d7a4e1c4';
    $timestamp = '2024-04-18T22:00:00.634234626Z';
    $message = $id.$timestamp.json_encode($challengePayload);

    $signature = 'sha256='.hash_hmac('sha256', $message, config('services.twitch.webhook_secret') ?? 'secret');

    $response = postJson('/webhooks/twitch', $challengePayload, [
        'Twitch-Eventsub-Subscription-Type' => 'webhook_callback_verification_pending',
        'Twitch-Eventsub-Message-Id' => $id,
        'Twitch-Eventsub-Message-Timestamp' => $timestamp,
        'Twitch-Eventsub-Message-Signature' => $signature,
    ]);

    $response->assertContent('pogchamp-kappa-360noscope-vohiyo');
});
