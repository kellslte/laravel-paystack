<?php

namespace Scwar\LaravelPaystack\Resources;

use Scwar\LaravelPaystack\Contracts\HttpClientInterface;
use Scwar\LaravelPaystack\Support\Pagination;

class Settlement extends BaseResource
{
    public function __construct(HttpClientInterface $client)
    {
        parent::__construct($client, 'settlement');
    }

    /**
     * List settlements.
     *
     * @param array $query
     * @return array{data: array, pagination: Pagination|null}
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('/settlement', $query);

        return [
            'data' => $this->extractData($response) ?? [],
            'pagination' => $this->getPagination($response),
        ];
    }

    /**
     * Fetch a settlement.
     *
     * @param string $id
     * @return array
     */
    public function fetch(string $id): array
    {
        $response = $this->client->get("/settlement/{$id}");

        return $this->extractData($response);
    }
}
