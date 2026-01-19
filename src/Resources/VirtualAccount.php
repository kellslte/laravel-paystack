<?php

namespace Scwar\LaravelPaystack\Resources;

use Scwar\LaravelPaystack\Contracts\HttpClientInterface;
use Scwar\LaravelPaystack\Support\Pagination;

class VirtualAccount extends BaseResource
{
    public function __construct(HttpClientInterface $client)
    {
        parent::__construct($client, 'dedicated_account');
    }

    /**
     * Create a dedicated virtual account.
     *
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        return $this->client->post('/dedicated_account', $data);
    }

    /**
     * Assign a dedicated account.
     *
     * @param array $data
     * @return array
     */
    public function assign(array $data): array
    {
        return $this->client->post('/dedicated_account/assign', $data);
    }

    /**
     * List dedicated accounts.
     *
     * @param array $query
     * @return array{data: array, pagination: Pagination|null}
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('/dedicated_account', $query);

        return [
            'data' => $this->extractData($response) ?? [],
            'pagination' => $this->getPagination($response),
        ];
    }

    /**
     * Fetch a dedicated account.
     *
     * @param string $dedicatedAccountId
     * @return array
     */
    public function fetch(string $dedicatedAccountId): array
    {
        $response = $this->client->get("/dedicated_account/{$dedicatedAccountId}");

        return $this->extractData($response);
    }

    /**
     * Deactivate a dedicated account.
     *
     * @param string $dedicatedAccountId
     * @return array
     */
    public function deactivate(string $dedicatedAccountId): array
    {
        return $this->client->delete("/dedicated_account/{$dedicatedAccountId}");
    }
}
