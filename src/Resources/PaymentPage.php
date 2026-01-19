<?php

namespace Scwar\LaravelPaystack\Resources;

use Scwar\LaravelPaystack\Contracts\HttpClientInterface;
use Scwar\LaravelPaystack\Support\Pagination;

class PaymentPage extends BaseResource
{
    public function __construct(HttpClientInterface $client)
    {
        parent::__construct($client, 'page');
    }

    /**
     * Create a payment page.
     *
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        $response = $this->client->post('/page', $data);

        return $this->extractData($response);
    }

    /**
     * List payment pages.
     *
     * @param array $query
     * @return array{data: array, pagination: Pagination|null}
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('/page', $query);

        return [
            'data' => $this->extractData($response) ?? [],
            'pagination' => $this->getPagination($response),
        ];
    }

    /**
     * Fetch a payment page.
     *
     * @param string $idOrSlug
     * @return array
     */
    public function fetch(string $idOrSlug): array
    {
        $response = $this->client->get("/page/{$idOrSlug}");

        return $this->extractData($response);
    }

    /**
     * Update a payment page.
     *
     * @param string $idOrSlug
     * @param array $data
     * @return array
     */
    public function update(string $idOrSlug, array $data): array
    {
        $response = $this->client->put("/page/{$idOrSlug}", $data);

        return $this->extractData($response);
    }

    /**
     * Check slug availability.
     *
     * @param string $slug
     * @return array
     */
    public function checkSlugAvailability(string $slug): array
    {
        return $this->client->get("/page/check_slug_availability/{$slug}");
    }
}
