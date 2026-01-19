<?php

namespace Scwar\LaravelPaystack\Resources;

use Scwar\LaravelPaystack\Contracts\HttpClientInterface;
use Scwar\LaravelPaystack\Support\Pagination;

class Product extends BaseResource
{
    public function __construct(HttpClientInterface $client)
    {
        parent::__construct($client, 'product');
    }

    /**
     * Create a product.
     *
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        return $this->client->post('/product', $data);
    }

    /**
     * List products.
     *
     * @param array $query
     * @return array{data: array, pagination: Pagination|null}
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('/product', $query);

        return [
            'data' => $this->extractData($response) ?? [],
            'pagination' => $this->getPagination($response),
        ];
    }

    /**
     * Fetch a product.
     *
     * @param string $id
     * @return array
     */
    public function fetch(string $id): array
    {
        $response = $this->client->get("/product/{$id}");

        return $this->extractData($response);
    }

    /**
     * Update a product.
     *
     * @param string $id
     * @param array $data
     * @return array
     */
    public function update(string $id, array $data): array
    {
        $response = $this->client->put("/product/{$id}", $data);

        return $this->extractData($response);
    }
}
