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
     * @param \Scwar\LaravelPaystack\DTOs\Requests\VirtualAccount\CreateDedicatedAccountRequest|array $request
     * @return \Scwar\LaravelPaystack\DTOs\Responses\VirtualAccount\DedicatedAccountData
     */
    public function create(\Scwar\LaravelPaystack\DTOs\Requests\VirtualAccount\CreateDedicatedAccountRequest|array $request): \Scwar\LaravelPaystack\DTOs\Responses\VirtualAccount\DedicatedAccountData
    {
        if (is_array($request)) {
            $request = \Scwar\LaravelPaystack\DTOs\Requests\VirtualAccount\CreateDedicatedAccountRequest::fromArray($request);
        }

        $response = $this->client->post('/dedicated_account', $request->toArray());

        return \Scwar\LaravelPaystack\DTOs\Responses\VirtualAccount\DedicatedAccountData::fromArray($this->extractData($response));
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
     * @return array{data: array<\Scwar\LaravelPaystack\DTOs\Responses\VirtualAccount\DedicatedAccountData>, pagination: Pagination|null}
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('/dedicated_account', $query);

        return [
            'data' => array_map(
                fn($item) => \Scwar\LaravelPaystack\DTOs\Responses\VirtualAccount\DedicatedAccountData::fromArray($item),
                $this->extractData($response) ?? []
            ),
            'pagination' => $this->getPagination($response),
        ];
    }

    /**
     * Fetch a dedicated account.
     *
     * @param string $dedicatedAccountId
     * @return \Scwar\LaravelPaystack\DTOs\Responses\VirtualAccount\DedicatedAccountData
     */
    public function fetch(string $dedicatedAccountId): \Scwar\LaravelPaystack\DTOs\Responses\VirtualAccount\DedicatedAccountData
    {
        $response = $this->client->get("/dedicated_account/{$dedicatedAccountId}");

        return \Scwar\LaravelPaystack\DTOs\Responses\VirtualAccount\DedicatedAccountData::fromArray($this->extractData($response));
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
