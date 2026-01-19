<?php

namespace Scwar\LaravelPaystack\Resources;

use Scwar\LaravelPaystack\Contracts\HttpClientInterface;
use Scwar\LaravelPaystack\Support\Pagination;

class Split extends BaseResource
{
    public function __construct(HttpClientInterface $client)
    {
        parent::__construct($client, 'split');
    }

    /**
     * Create a split.
     *
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        return $this->client->post('/split', $data);
    }

    /**
     * List splits.
     *
     * @param array $query
     * @return array{data: array, pagination: Pagination|null}
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('/split', $query);

        return [
            'data' => $this->extractData($response) ?? [],
            'pagination' => $this->getPagination($response),
        ];
    }

    /**
     * Fetch a split.
     *
     * @param string $id
     * @return array
     */
    public function fetch(string $id): array
    {
        $response = $this->client->get("/split/{$id}");

        return $this->extractData($response);
    }

    /**
     * Update a split.
     *
     * @param string $id
     * @param array $data
     * @return array
     */
    public function update(string $id, array $data): array
    {
        $response = $this->client->put("/split/{$id}", $data);

        return $this->extractData($response);
    }

    /**
     * Add a subaccount to a split.
     *
     * @param string $id
     * @param array $data
     * @return array
     */
    public function addSubaccount(string $id, array $data): array
    {
        return $this->client->post("/split/{$id}/subaccount/add", $data);
    }

    /**
     * Remove a subaccount from a split.
     *
     * @param string $id
     * @param string $subaccount
     * @return array
     */
    public function removeSubaccount(string $id, string $subaccount): array
    {
        return $this->client->post("/split/{$id}/subaccount/remove", [
            'subaccount' => $subaccount,
        ]);
    }
}
