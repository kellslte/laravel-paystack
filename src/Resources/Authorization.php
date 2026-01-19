<?php

namespace Scwar\LaravelPaystack\Resources;

use Scwar\LaravelPaystack\Contracts\HttpClientInterface;
use Scwar\LaravelPaystack\Support\Pagination;

class Authorization extends BaseResource
{
    public function __construct(HttpClientInterface $client)
    {
        parent::__construct($client, 'authorization');
    }

    /**
     * List authorizations.
     *
     * @param array $query
     * @return array{data: array, pagination: Pagination|null}
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('/authorization', $query);

        return [
            'data' => $this->extractData($response) ?? [],
            'pagination' => $this->getPagination($response),
        ];
    }

    /**
     * Fetch an authorization.
     *
     * @param string $authorizationCode
     * @return array
     */
    public function fetch(string $authorizationCode): array
    {
        $response = $this->client->get("/authorization/{$authorizationCode}");

        return $this->extractData($response);
    }

    /**
     * Check authorization.
     *
     * @param string $authorizationCode
     * @param array $data
     * @return array
     */
    public function check(string $authorizationCode, array $data): array
    {
        $response = $this->client->post("/authorization/check/{$authorizationCode}", $data);

        return $this->extractData($response);
    }
}
