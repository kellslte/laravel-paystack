<?php

namespace Scwar\LaravelPaystack\Resources;

use Scwar\LaravelPaystack\Contracts\HttpClientInterface;
use Scwar\LaravelPaystack\DTOs\Requests\Subaccount\CreateSubaccountRequest;
use Scwar\LaravelPaystack\DTOs\Responses\Subaccount\SubaccountData;
use Scwar\LaravelPaystack\Support\Pagination;

class Subaccount extends BaseResource
{
    public function __construct(HttpClientInterface $client)
    {
        parent::__construct($client, 'subaccount');
    }

    /**
     * Create a subaccount.
     *
     * @param CreateSubaccountRequest|array $request
     * @return SubaccountData
     */
    public function create(CreateSubaccountRequest|array $request): SubaccountData
    {
        if (is_array($request)) {
            $request = CreateSubaccountRequest::fromArray($request);
        }

        $response = $this->client->post('/subaccount', $request->toArray());

        return SubaccountData::fromArray($this->extractData($response));
    }

    /**
     * List subaccounts.
     *
     * @param array $query
     * @return array{data: array<SubaccountData>, pagination: Pagination|null}
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('/subaccount', $query);

        return [
            'data' => array_map(
                fn($item) => SubaccountData::fromArray($item),
                $this->extractData($response) ?? []
            ),
            'pagination' => $this->getPagination($response),
        ];
    }

    /**
     * Fetch a subaccount.
     *
     * @param string $idOrCode
     * @return SubaccountData
     */
    public function fetch(string $idOrCode): SubaccountData
    {
        $response = $this->client->get("/subaccount/{$idOrCode}");

        return SubaccountData::fromArray($this->extractData($response));
    }

    /**
     * Update a subaccount.
     *
     * @param string $idOrCode
     * @param array $data
     * @return SubaccountData
     */
    public function update(string $idOrCode, array $data): SubaccountData
    {
        $response = $this->client->put("/subaccount/{$idOrCode}", $data);

        return SubaccountData::fromArray($this->extractData($response));
    }
}
