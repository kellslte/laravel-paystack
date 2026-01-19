<?php

use Mockery;
use Scwar\LaravelPaystack\Contracts\HttpClientInterface;
use Scwar\LaravelPaystack\Resources\Customer;
use Scwar\LaravelPaystack\Tests\TestCase;

uses(TestCase::class);

it('can create a customer', function () {
    $mockClient = Mockery::mock(HttpClientInterface::class);
    $mockClient->shouldReceive('post')
        ->once()
        ->with('/customer', Mockery::type('array'))
        ->andReturn([
            'status' => true,
            'data' => [
                'id' => 1,
                'email' => 'test@example.com',
                'customer_code' => 'CUS_123',
            ],
        ]);

    $customer = new Customer($mockClient);
    $result = $customer->create([
        'email' => 'test@example.com',
        'first_name' => 'John',
    ]);

    expect($result->email)->toBe('test@example.com')
        ->and($result->customerCode)->toBe('CUS_123');
});

it('can list customers', function () {
    $mockClient = Mockery::mock(HttpClientInterface::class);
    $mockClient->shouldReceive('get')
        ->once()
        ->with('/customer', [])
        ->andReturn([
            'status' => true,
            'data' => [
                ['id' => 1, 'email' => 'test1@example.com'],
                ['id' => 2, 'email' => 'test2@example.com'],
            ],
            'meta' => [
                'total' => 2,
                'perPage' => 50,
                'page' => 1,
                'pageCount' => 1,
            ],
        ]);

    $customer = new Customer($mockClient);
    $result = $customer->list();

    expect($result['data'])->toHaveCount(2)
        ->and($result['pagination'])->not->toBeNull();
});
