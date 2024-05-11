<?php

namespace App\Jobs\Webhooks;

use App\Abstracts\Webhook\ProcessWebhookJob;
use App\Models\Channel;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class TwitchWebhookJob extends ProcessWebhookJob
{
    /**
     * Get the validation rules that apply to the webhook payload.
     */
    public function validation(): array
    {
        return [
            'challenge' => [Rule::requiredIf(fn () => in_array($this->webhookCall->headers()->get('twitch-eventsub-message-type'), ['webhook_callback_verification', 'webhook_callback_verification_pending'])), 'string'],
            'subscription' => ['required', 'array'],
            'subscription.id' => ['required', 'string'],
            'subscription.status' => ['required', 'string'],
            'subscription.type' => ['required', 'string'],
            'subscription.version' => ['required', 'string'],
            'subscription.condition' => ['required', 'array'],
            'subscription.condition.broadcaster_user_id' => ['required', 'string'],
        ];
    }

    /**
     * Handle the job.
     */
    public function handle()
    {
        if ($this->webhookCall->headers()->get('twitch-eventsub-message-type') === 'notification' && in_array($this->webhookCall->headers()->get('twitch-eventsub-subscription-type'), ['stream.online', 'stream.offline'])) {
            $channel = Channel::find('twitch_id', Arr::get($this->payload, 'subscription.condition.broadcaster_user_id'));

            $channel->update([
                'is_online' => Arr::get($this->payload, 'subscription.type') === 'stream.online',
            ]);
        }
    }
}
