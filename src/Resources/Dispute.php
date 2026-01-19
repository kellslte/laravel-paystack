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
     * @return array{data: array<\Scwar\LaravelPaystack\DTOs\Responses\Dispute\DisputeData>, pagination: Pagination|null}
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('/dispute', $query);

        return [
            'data' => array_map(
                fn($item) => \Scwar\LaravelPaystack\DTOs\Responses\Dispute\DisputeData::fromArray($item),
                $this->extractData($response) ?? []
            ),
            'pagination' => $this->getPagination($response),
        ];
    }

    /**
     * Fetch a dispute.
     *
     * @param string $id
     * @return \Scwar\LaravelPaystack\DTOs\Responses\Dispute\DisputeData
     */
    public function fetch(string $id): \Scwar\LaravelPaystack\DTOs\Responses\Dispute\DisputeData
    {
        $response = $this->client->get("/dispute/{$id}");

        return \Scwar\LaravelPaystack\DTOs\Responses\Dispute\DisputeData::fromArray($this->extractData($response));
    }

    /**
     * Update a dispute.
     *
     * @param string $id
     * @param array $data
     * @return \Scwar\LaravelPaystack\DTOs\Responses\Dispute\DisputeData
     */
    public function update(string $id, array $data): \Scwar\LaravelPaystack\DTOs\Responses\Dispute\DisputeData
    {
        $response = $this->client->put("/dispute/{$id}", $data);

        return \Scwar\LaravelPaystack\DTOs\Responses\Dispute\DisputeData::fromArray($this->extractData($response));
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
