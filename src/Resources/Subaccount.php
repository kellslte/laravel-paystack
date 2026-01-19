<?php

namespace Scwar\LaravelPaystack\Resources;

use Scwar\LaravelPaystack\Contracts\HttpClientInterface;
use Scwar\LaravelPaystack\Support\Pagination;

class Subaccount extends BaseResource
{
    public function __construct(HttpClientInterface $client)
    {
        parent::__construct($client, 'subaccount');
    }

    /**
     * Create a subaccount.
     *
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        return $this->client->post('/subaccount', $data);
    }

    /**
     * List subaccounts.
     *
     * @param array $query
     * @return array{data: array, pagination: Pagination|null}
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('/subaccount', $query);

        return [
            'data' => $this->extractData($response) ?? [],
            'pagination' => $this->getPagination($response),
        ];
    }

    /**
     * Fetch a subaccount.
     *
     * @param string $idOrCode
     * @return array
     */
    public function fetch(string $idOrCode): array
    {
        $response = $this->client->get("/subaccount/{$idOrCode}");

        return $this->extractData($response);
    }

    /**
     * Update a subaccount.
     *
     * @param string $idOrCode
     * @param array $data
     * @return array
     */
    public function update(string $idOrCode, array $data): array
    {
        $response = $this->client->put("/subaccount/{$idOrCode}", $data);

        return $this->extractData($response);
    }
}
