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
        if (in_array($request->header('twitch-eventsub-message-type'), ['webhook_callback_verification', 'webhook_callback_verification_pending'])) {
            return response(
                Arr::get($request->input(), 'challenge'),
                Response::HTTP_OK,
                ['Content-Type' => 'text/plain'],
            );
        }

        return response()->json(['message' => 'ok']);
    }
}
