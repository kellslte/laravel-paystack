<?php

namespace Scwar\LaravelPaystack\Resources;

use Scwar\LaravelPaystack\Contracts\HttpClientInterface;
use Scwar\LaravelPaystack\Support\Pagination;
use Scwar\LaravelPaystack\Support\ResponseParser;

abstract class BaseResource
{
    protected HttpClientInterface $client;
    protected string $endpoint;

    public function __construct(HttpClientInterface $client, string $endpoint = '')
    {
        $this->client = $client;
        $this->endpoint = $endpoint;
    }

    /**
     * Get pagination from response meta.
     *
     * @param array $response
     * @return Pagination|null
     */
    protected function getPagination(array $response): ?Pagination
    {
        $meta = ResponseParser::extractMeta($response);

        if (!$meta) {
            return null;
        }

        return Pagination::fromMeta($meta);
    }

    /**
     * Extract data from response.
     *
     * @param array $response
     * @return mixed
     */
    protected function extractData(array $response): mixed
    {
        return ResponseParser::extractData($response);
    }
}
