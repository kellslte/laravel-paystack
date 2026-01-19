<?php

use Illuminate\Http\Request;
use Scwar\LaravelPaystack\Support\WebhookSignature;
use Scwar\LaravelPaystack\Webhooks\WebhookController;
use Scwar\LaravelPaystack\Webhooks\WebhookMiddleware;
use Scwar\LaravelPaystack\Tests\TestCase;

uses(TestCase::class);

beforeEach(function () {
    config(['paystack.webhook_secret' => 'test_secret']);
});

it('can verify webhook signature in middleware', function () {
    $payload = json_encode(['event' => 'charge.success', 'data' => []]);
    $signature = hash_hmac('sha512', $payload, 'test_secret');

    $request = Request::create('/webhook', 'POST', [], [], [], [
        'HTTP_X_PAYSTACK_SIGNATURE' => $signature,
    ], $payload);

    $middleware = new WebhookMiddleware();
    $called = false;

    $response = $middleware->handle($request, function () use (&$called) {
        $called = true;
        return response()->json(['status' => true]);
    });

    expect($called)->toBeTrue()
        ->and($response->getStatusCode())->toBe(200);
});

it('rejects invalid webhook signature', function () {
    $payload = json_encode(['event' => 'charge.success', 'data' => []]);
    $invalidSignature = 'invalid_signature';

    $request = Request::create('/webhook', 'POST', [], [], [], [
        'HTTP_X_PAYSTACK_SIGNATURE' => $invalidSignature,
    ], $payload);

    $middleware = new WebhookMiddleware();

    expect(fn() => $middleware->handle($request, fn() => response()->json([])))
        ->toThrow(Exception::class);
});
