<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

use Saloon\Http\Faking\MockClient;
use Spatie\WebhookClient\Models\WebhookCall;

uses(
    Tests\TestCase::class,
    Illuminate\Foundation\Testing\RefreshDatabase::class,
)
    ->beforeEach(function () {
        MockClient::destroyGlobal();
    })
    ->in('Feature');

/**
 * Create a new Webhook call instance.
 */
function createWebhookCall(string $name, string $route, array $payload = [], array $headers = []): WebhookCall
{
    $url = route($route);

    return WebhookCall::create(
        compact('name', 'url', 'payload', 'headers')
    );
}
