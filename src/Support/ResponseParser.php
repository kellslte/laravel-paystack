<?php

namespace Scwar\LaravelPaystack\Support;

class ResponseParser
{
    /**
     * Parse Paystack API response.
     *
     * @param array $response
     * @return array{data: mixed, status: bool, message: string, meta?: array}
     */
    public static function parse(array $response): array
    {
        return [
            'data' => $response['data'] ?? null,
            'status' => $response['status'] ?? false,
            'message' => $response['message'] ?? '',
            'meta' => $response['meta'] ?? null,
        ];
    }

    /**
     * Extract data from response.
     *
     * @param array $response
     * @return mixed
     */
    public static function extractData(array $response): mixed
    {
        return $response['data'] ?? null;
    }

    /**
     * Extract meta from response.
     *
     * @param array $response
     * @return array|null
     */
    public static function extractMeta(array $response): ?array
    {
        return $response['meta'] ?? null;
    }

    /**
     * Check if response is successful.
     *
     * @param array $response
     * @return bool
     */
    public static function isSuccess(array $response): bool
    {
        return ($response['status'] ?? false) === true;
    }
}
