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
     * @param \Scwar\LaravelPaystack\DTOs\Requests\TransferRecipient\CreateTransferRecipientRequest|array $request
     * @return \Scwar\LaravelPaystack\DTOs\Responses\TransferRecipient\TransferRecipientData
     */
    public function create(\Scwar\LaravelPaystack\DTOs\Requests\TransferRecipient\CreateTransferRecipientRequest|array $request): \Scwar\LaravelPaystack\DTOs\Responses\TransferRecipient\TransferRecipientData
    {
        if (is_array($request)) {
            $request = \Scwar\LaravelPaystack\DTOs\Requests\TransferRecipient\CreateTransferRecipientRequest::fromArray($request);
        }

        $response = $this->client->post('/transferrecipient', $request->toArray());

        return \Scwar\LaravelPaystack\DTOs\Responses\TransferRecipient\TransferRecipientData::fromArray($this->extractData($response));
    }

    /**
     * List transfer recipients.
     *
     * @param array $query
     * @return array{data: array<\Scwar\LaravelPaystack\DTOs\Responses\TransferRecipient\TransferRecipientData>, pagination: Pagination|null}
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('/transferrecipient', $query);

        return [
            'data' => array_map(
                fn($item) => \Scwar\LaravelPaystack\DTOs\Responses\TransferRecipient\TransferRecipientData::fromArray($item),
                $this->extractData($response) ?? []
            ),
            'pagination' => $this->getPagination($response),
        ];
    }

    /**
     * Fetch a transfer recipient.
     *
     * @param string $idOrCode
     * @return \Scwar\LaravelPaystack\DTOs\Responses\TransferRecipient\TransferRecipientData
     */
    public function fetch(string $idOrCode): \Scwar\LaravelPaystack\DTOs\Responses\TransferRecipient\TransferRecipientData
    {
        $response = $this->client->get("/transferrecipient/{$idOrCode}");

        return \Scwar\LaravelPaystack\DTOs\Responses\TransferRecipient\TransferRecipientData::fromArray($this->extractData($response));
    }

    /**
     * Update a transfer recipient.
     *
     * @param string $idOrCode
     * @param array $data
     * @return \Scwar\LaravelPaystack\DTOs\Responses\TransferRecipient\TransferRecipientData
     */
    public function update(string $idOrCode, array $data): \Scwar\LaravelPaystack\DTOs\Responses\TransferRecipient\TransferRecipientData
    {
        $response = $this->client->put("/transferrecipient/{$idOrCode}", $data);

        return \Scwar\LaravelPaystack\DTOs\Responses\TransferRecipient\TransferRecipientData::fromArray($this->extractData($response));
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
