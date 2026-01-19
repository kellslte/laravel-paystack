<?php

namespace Scwar\LaravelPaystack\Resources;

use Scwar\LaravelPaystack\Contracts\HttpClientInterface;
use Scwar\LaravelPaystack\Support\Pagination;

class Plan extends BaseResource
{
    public function __construct(HttpClientInterface $client)
    {
        parent::__construct($client, 'plan');
    }

    /**
     * Create a plan.
     *
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        return $this->client->post('/plan', $data);
    }

    /**
     * List plans.
     *
     * @param array $query
     * @return array{data: array, pagination: Pagination|null}
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('/plan', $query);

        return [
            'data' => $this->extractData($response) ?? [],
            'pagination' => $this->getPagination($response),
        ];
    }

    /**
     * Fetch a plan.
     *
     * @param string $idOrCode
     * @return array
     */
    public function fetch(string $idOrCode): array
    {
        $response = $this->client->get("/plan/{$idOrCode}");

        return $this->extractData($response);
    }

    /**
     * Update a plan.
     *
     * @param string $idOrCode
     * @param array $data
     * @return array
     */
    public function update(string $idOrCode, array $data): array
    {
        $response = $this->client->put("/plan/{$idOrCode}", $data);

        return $this->extractData($response);
    }
}
