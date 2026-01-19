<?php

use Scwar\LaravelPaystack\Support\WebhookSignature;

it('can verify webhook signature', function () {
    $payload = '{"event":"charge.success","data":{}}';
    $secret = 'test_secret';
    $signature = hash_hmac('sha512', $payload, $secret);

    expect(WebhookSignature::verify($payload, $signature, $secret))->toBeTrue();
});

it('returns false for invalid signature', function () {
    $payload = '{"event":"charge.success","data":{}}';
    $secret = 'test_secret';
    $invalidSignature = 'invalid_signature';

    expect(WebhookSignature::verify($payload, $invalidSignature, $secret))->toBeFalse();
});

it('returns false for empty signature or secret', function () {
    $payload = '{"event":"charge.success","data":{}}';

    expect(WebhookSignature::verify($payload, '', 'secret'))->toBeFalse()
        ->and(WebhookSignature::verify($payload, 'signature', ''))->toBeFalse();
});
