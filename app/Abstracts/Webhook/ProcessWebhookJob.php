<?php

namespace App\Abstracts\Webhook;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob as BaseProcessWebhookJob;
use Spatie\WebhookClient\Models\WebhookCall;

abstract class ProcessWebhookJob extends BaseProcessWebhookJob
{
    /**
     * The payload instance.
     */
    public array $payload;

    /**
     * Create a new job instance.
     */
    public function __construct(public WebhookCall $webhookCall)
    {
        parent::__construct($webhookCall);

        $this->validate();
    }

    /**
     * Get the validation rules that apply to the webhook payload.
     */
    abstract public function validation(): array;

    /**
     * Validate the webhook payload.
     */
    public function validate(): void
    {
        $validator = Validator::make((array) $this->webhookCall->payload, $this->validation());

        throw_if($validator->fails(), new ValidationException($validator));

        $this->payload = $validator->validated();
    }
}
