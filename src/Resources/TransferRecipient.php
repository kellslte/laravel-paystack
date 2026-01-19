<?php

namespace Scwar\LaravelPaystack\Resources;

use Scwar\LaravelPaystack\Contracts\HttpClientInterface;
use Scwar\LaravelPaystack\Support\Pagination;

class TransferRecipient extends BaseResource
{
    public function __construct(HttpClientInterface $client)
    {
        parent::__construct($client, 'transferrecipient');
    }

    /**
     * Create a transfer recipient.
     *
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        return $this->client->post('/transferrecipient', $data);
    }

    /**
     * List transfer recipients.
     *
     * @param array $query
     * @return array{data: array, pagination: Pagination|null}
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('/transferrecipient', $query);

        return [
            'data' => $this->extractData($response) ?? [],
            'pagination' => $this->getPagination($response),
        ];
    }

    /**
     * Fetch a transfer recipient.
     *
     * @param string $idOrCode
     * @return array
     */
    public function fetch(string $idOrCode): array
    {
        $response = $this->client->get("/transferrecipient/{$idOrCode}");

        return $this->extractData($response);
    }

    /**
     * Update a transfer recipient.
     *
     * @param string $idOrCode
     * @param array $data
     * @return array
     */
    public function update(string $idOrCode, array $data): array
    {
        $response = $this->client->put("/transferrecipient/{$idOrCode}", $data);

        return $this->extractData($response);
    }

    /**
     * Delete a transfer recipient.
     *
     * @param string $idOrCode
     * @return array
     */
    public function delete(string $idOrCode): array
    {
        return $this->client->delete("/transferrecipient/{$idOrCode}");
    }
}
