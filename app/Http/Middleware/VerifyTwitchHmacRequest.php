<?php

namespace App\Http\Middleware;

class VerifyTwitchHmacRequest
{
    public function handle($request, $next)
    {
        $signature = $request->header('Twitch-Eventsub-Message-Signature');
        $timestamp = $request->header('Twitch-Eventsub-Message-Timestamp');
        $messageId = $request->header('Twitch-Eventsub-Message-Id');
        $body = $request->getContent();

        $secret = config('services.twitch.webhook_secret');

        $message = $messageId . $timestamp . $body;

        $calculatedSignature = 'sha256=' . hash_hmac('sha256', $message, $secret);

        if (!hash_equals($signature, $calculatedSignature)) {
            abort(403, 'Invalid signature');
        }

        return $next($request);
    }
}
