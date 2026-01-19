<?php

namespace Scwar\LaravelPaystack\Resources;

use Scwar\LaravelPaystack\Contracts\HttpClientInterface;
use Scwar\LaravelPaystack\Support\Pagination;

class Refund extends BaseResource
{
    public function __construct(HttpClientInterface $client)
    {
        parent::__construct($client, 'refund');
    }

    /**
     * Create a refund.
     *
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        return $this->client->post('/refund', $data);
    }

    /**
     * List refunds.
     *
     * @param array $query
     * @return array{data: array, pagination: Pagination|null}
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('/refund', $query);

        return [
            'data' => $this->extractData($response) ?? [],
            'pagination' => $this->getPagination($response),
        ];
    }

    /**
     * Fetch a refund.
     *
     * @param string $idOrReference
     * @return array
     */
    public function fetch(string $idOrReference): array
    {
        $response = $this->client->get("/refund/{$idOrReference}");

        return $this->extractData($response);
    }
}
