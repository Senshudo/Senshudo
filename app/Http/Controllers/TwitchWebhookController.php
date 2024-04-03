<?php

namespace App\Http\Controllers;

use App\Events\LiveStreamUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TwitchWebhookController extends Controller
{
    public function __invoke(Request $request)
    {
        if (!in_array($request->header('Twitch-Eventsub-Message-Type'), ['webhook_callback_verification', 'notification', 'revocation'])) {
            abort(404, 'Invalid message type');
        }

        if ($request->header('Twitch-Eventsub-Message-Type') === 'webhook_callback_verification') {
            $notification = json_decode($request->getContent());

            return response($notification->challenge, 200, ['Content-Type' => 'text/plain']);
        }

        if ($request->header('Twitch-Eventsub-Message-Type') === 'revocation') {
            $notification = json_decode($request->getContent());

            Log::warning("Subscription revoked: {$notification->subscription->status}");

            return response()->noContent();
        }

        if ($request->header('Twitch-Eventsub-Message-Type') === 'notification') {
            $notification = json_decode($request->getContent());

            Log::info([
                $request->header('Twitch-Eventsub-Subscription-Type'),
                $notification->event,
            ]);

            return match($request->header('Twitch-Eventsub-Subscription-Type')) {
                'stream.online' => $this->streamOnline($notification),
                'stream.offline' => $this->streamOffline($notification),
                default => abort(404),
            };
        }
    }

    private function streamOnline($notification)
    {
        LiveStreamUpdated::dispatch($notification->event->broadcaster_user_login, true);

        return response()->noContent();
    }

    private function streamOffline($notification)
    {
        LiveStreamUpdated::dispatch($notification->event->broadcaster_user_login, false);

        return response()->noContent();
    }
}
