<?php

namespace Scwar\LaravelPaystack\Resources;

use Scwar\LaravelPaystack\Contracts\HttpClientInterface;
use Scwar\LaravelPaystack\Support\Pagination;

class Dispute extends BaseResource
{
    public function __construct(HttpClientInterface $client)
    {
        parent::__construct($client, 'dispute');
    }

    /**
     * List disputes.
     *
     * @param array $query
     * @return array{data: array, pagination: Pagination|null}
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('/dispute', $query);

        return [
            'data' => $this->extractData($response) ?? [],
            'pagination' => $this->getPagination($response),
        ];
    }

    /**
     * Fetch a dispute.
     *
     * @param string $id
     * @return array
     */
    public function fetch(string $id): array
    {
        $response = $this->client->get("/dispute/{$id}");

        return $this->extractData($response);
    }

    /**
     * Update a dispute.
     *
     * @param string $id
     * @param array $data
     * @return array
     */
    public function update(string $id, array $data): array
    {
        $response = $this->client->put("/dispute/{$id}", $data);

        return $this->extractData($response);
    }

    /**
     * Export disputes.
     *
     * @param array $query
     * @return array
     */
    public function export(array $query = []): array
    {
        return $this->client->get('/dispute/export', $query);
    }

    /**
     * Add evidence to a dispute.
     *
     * @param string $id
     * @param array $data
     * @return array
     */
    public function addEvidence(string $id, array $data): array
    {
        return $this->client->post("/dispute/{$id}/evidence", $data);
    }

    /**
     * Upload evidence URL.
     *
     * @param string $id
     * @param array $data
     * @return array
     */
    public function uploadEvidenceUrl(string $id, array $data): array
    {
        return $this->client->post("/dispute/{$id}/evidence/upload", $data);
    }
}
