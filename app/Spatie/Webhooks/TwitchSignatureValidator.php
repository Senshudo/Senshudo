<?php

namespace App\Spatie\Webhooks;

use Illuminate\Http\Request;
use Spatie\WebhookClient\Exceptions\InvalidConfig;
use Spatie\WebhookClient\SignatureValidator\SignatureValidator;
use Spatie\WebhookClient\WebhookConfig;

class TwitchSignatureValidator implements SignatureValidator
{
    public function isValid(Request $request, WebhookConfig $config): bool
    {
        $signature = $request->header('Twitch-Eventsub-Message-Signature');
        $timestamp = $request->header('Twitch-Eventsub-Message-Timestamp');
        $messageId = $request->header('Twitch-Eventsub-Message-Id');

        if (! $signature || ! $timestamp || ! $messageId) {
            return false;
        }

        $signingSecret = $config->signingSecret;

        throw_if($signingSecret === '' || $signingSecret === '0', InvalidConfig::signingSecretNotSet());

        $body = $request->getContent();

        $message = $messageId.$timestamp.$body;

        $computedSignature = 'sha256='.hash_hmac('sha256', $message, $signingSecret);

        return hash_equals($signature, $computedSignature);
    }
}
