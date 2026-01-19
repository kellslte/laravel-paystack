<?php

namespace Scwar\LaravelPaystack\Resources;

use Scwar\LaravelPaystack\Contracts\HttpClientInterface;
use Scwar\LaravelPaystack\DTOs\Requests\Product\CreateProductRequest;
use Scwar\LaravelPaystack\DTOs\Requests\Product\UpdateProductRequest;
use Scwar\LaravelPaystack\DTOs\Responses\Product\ProductData;
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
     * @param CreateProductRequest|array $request
     * @return ProductData
     */
    public function create(CreateProductRequest|array $request): ProductData
    {
        if (is_array($request)) {
            $request = CreateProductRequest::fromArray($request);
        }

        $response = $this->client->post('/product', $request->toArray());

        return ProductData::fromArray($this->extractData($response));
    }

    /**
     * List products.
     *
     * @param array $query
     * @return array{data: array<ProductData>, pagination: Pagination|null}
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('/product', $query);

        return [
            'data' => array_map(
                fn($item) => ProductData::fromArray($item),
                $this->extractData($response) ?? []
            ),
            'pagination' => $this->getPagination($response),
        ];
    }

    /**
     * Fetch a product.
     *
     * @param string $id
     * @return ProductData
     */
    public function fetch(string $id): ProductData
    {
        $response = $this->client->get("/product/{$id}");

        return ProductData::fromArray($this->extractData($response));
    }

    /**
     * Update a product.
     *
     * @param string $id
     * @param UpdateProductRequest|array $request
     * @return ProductData
     */
    public function update(string $id, UpdateProductRequest|array $request): ProductData
    {
        if (is_array($request)) {
            $request = UpdateProductRequest::fromArray($request);
        }

        $response = $this->client->put("/product/{$id}", $request->toArray());

        return ProductData::fromArray($this->extractData($response));
    }
}
