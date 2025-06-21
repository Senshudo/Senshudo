<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'twitch' => [
        'client_id' => env('TWITCH_CLIENT_ID'),
        'client_secret' => env('TWITCH_CLIENT_SECRET'),
        'token' => env('TWITCH_TOKEN'),
        'webhook_secret' => env('TWITCH_WEBHOOK_SECRET'),
    ],

    'discord' => [
        'client_id' => env('DISCORD_CLIENT_ID'),
        'client_secret' => env('DISCORD_CLIENT_SECRET'),
        'bot_token' => env('DISCORD_API_BOT_TOKEN'),
        'public_key' => env('DISCORD_PUBLIC_KEY'),
        'redirect' => env('DISCORD_REDIRECT_URI'),
        'allow_gif_avatars' => (bool) env('DISCORD_AVATAR_GIF', true),
        'avatar_default_extension' => env('DISCORD_EXTENSION_DEFAULT', 'png'),
        'enabled' => ! empty(env('DISCORD_CLIENT_ID')) && ! empty(env('DISCORD_CLIENT_SECRET')),
        'permissions' => env('DISCORD_PERMISSIONS', 0),
        'server_id' => env('DISCORD_SERVER_ID'),
        'event_role' => env('DISCORD_EVENT_ROLE_ID'),
        'channels' => [
            'announcements' => env('DISCORD_CHANNEL_ANNOUNCEMENTS_ID'),
            'polls' => env('DISCORD_POLL_CHANNEL_ID'),
        ],
    ],

];
