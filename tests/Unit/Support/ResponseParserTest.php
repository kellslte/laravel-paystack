<?php

use Scwar\LaravelPaystack\Support\ResponseParser;

it('can parse response', function () {
    $response = [
        'status' => true,
        'message' => 'Success',
        'data' => ['id' => 1],
        'meta' => ['page' => 1],
    ];

    $parsed = ResponseParser::parse($response);

    expect($parsed)->toHaveKeys(['data', 'status', 'message', 'meta'])
        ->and($parsed['status'])->toBeTrue()
        ->and($parsed['message'])->toBe('Success');
});

it('can extract data from response', function () {
    $response = [
        'status' => true,
        'data' => ['id' => 1],
    ];

    $data = ResponseParser::extractData($response);

    expect($data)->toBe(['id' => 1]);
});

it('can check if response is successful', function () {
    $successResponse = ['status' => true];
    $failureResponse = ['status' => false];

    expect(ResponseParser::isSuccess($successResponse))->toBeTrue()
        ->and(ResponseParser::isSuccess($failureResponse))->toBeFalse();
});
