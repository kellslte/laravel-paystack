<?php

namespace Scwar\LaravelPaystack\Resources;

use Scwar\LaravelPaystack\Contracts\HttpClientInterface;
use Scwar\LaravelPaystack\DTOs\Requests\Split\CreateSplitRequest;
use Scwar\LaravelPaystack\DTOs\Responses\Split\SplitData;
use Scwar\LaravelPaystack\Support\Pagination;

class Split extends BaseResource
{
    public function __construct(HttpClientInterface $client)
    {
        parent::__construct($client, 'split');
    }

    /**
     * Create a split.
     *
     * @param CreateSplitRequest|array $request
     * @return SplitData
     */
    public function create(CreateSplitRequest|array $request): SplitData
    {
        if (is_array($request)) {
            $request = CreateSplitRequest::fromArray($request);
        }

        $response = $this->client->post('/split', $request->toArray());

        return SplitData::fromArray($this->extractData($response));
    }

    /**
     * List splits.
     *
     * @param array $query
     * @return array{data: array<SplitData>, pagination: Pagination|null}
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('/split', $query);

        return [
            'data' => array_map(
                fn($item) => SplitData::fromArray($item),
                $this->extractData($response) ?? []
            ),
            'pagination' => $this->getPagination($response),
        ];
    }

    /**
     * Fetch a split.
     *
     * @param string $id
     * @return SplitData
     */
    public function fetch(string $id): SplitData
    {
        $response = $this->client->get("/split/{$id}");

        return SplitData::fromArray($this->extractData($response));
    }

    /**
     * Update a split.
     *
     * @param string $id
     * @param array $data
     * @return SplitData
     */
    public function update(string $id, array $data): SplitData
    {
        $response = $this->client->put("/split/{$id}", $data);

        return SplitData::fromArray($this->extractData($response));
    }

    /**
     * Add a subaccount to a split.
     *
     * @param string $id
     * @param array $data
     * @return SplitData
     */
    public function addSubaccount(string $id, array $data): SplitData
    {
        $response = $this->client->post("/split/{$id}/subaccount/add", $data);

        return SplitData::fromArray($this->extractData($response));
    }

    /**
     * Remove a subaccount from a split.
     *
     * @param string $id
     * @param string $subaccount
     * @return SplitData
     */
    public function removeSubaccount(string $id, string $subaccount): SplitData
    {
        $response = $this->client->post("/split/{$id}/subaccount/remove", [
            'subaccount' => $subaccount,
        ]);

        return SplitData::fromArray($this->extractData($response));
    }
}
