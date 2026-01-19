<?php

use Mockery;
use Scwar\LaravelPaystack\Contracts\HttpClientInterface;
use Scwar\LaravelPaystack\Resources\Transaction;

it('can initialize a transaction', function () {
    $mockClient = Mockery::mock(HttpClientInterface::class);
    $mockClient->shouldReceive('post')
        ->once()
        ->with('/transaction/initialize', Mockery::type('array'))
        ->andReturn([
            'status' => true,
            'message' => 'Authorization URL created',
            'data' => [
                'authorization_url' => 'https://checkout.paystack.com/xxx',
                'access_code' => 'access_code_123',
                'reference' => 'ref_123',
            ],
        ]);

    $transaction = new Transaction($mockClient);
    $result = $transaction->initialize([
        'amount' => 10000,
        'email' => 'test@example.com',
    ]);

    expect($result->status)->toBeTrue()
        ->and($result->data->authorizationUrl)->toBe('https://checkout.paystack.com/xxx');
});

it('can verify a transaction', function () {
    $mockClient = Mockery::mock(HttpClientInterface::class);
    $mockClient->shouldReceive('get')
        ->once()
        ->with('/transaction/verify/ref_123', [])
        ->andReturn([
            'status' => true,
            'data' => [
                'id' => 1,
                'domain' => 'test',
                'status' => 'success',
                'reference' => 'ref_123',
                'amount' => 10000,
            ],
        ]);

    $transaction = new Transaction($mockClient);
    $result = $transaction->verify('ref_123');

    expect($result->reference)->toBe('ref_123')
        ->and($result->amount)->toBe(10000);
});
