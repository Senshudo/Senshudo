<?php

namespace App\Http\Controllers\WebhookResponse;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Spatie\WebhookClient\WebhookConfig;
use Spatie\WebhookClient\WebhookResponse\RespondsToWebhook;
use Symfony\Component\HttpFoundation\Response;

class TwitchWebhookResponse implements RespondsToWebhook
{
    /**
     * Respond to a valid webhook.
     */
    public function respondToValidWebhook(Request $request, WebhookConfig $config): Response
    {
        if ($request->header('Twitch-Eventsub-Subscription-Type') === 'webhook_callback_verification') {
            return response(
                Arr::get($request->input(), 'challenge'),
                Response::HTTP_OK,
                ['Content-Type' => 'text/plain'],
            );
        }

        return response()->json(['message' => 'ok']);
    }
}
