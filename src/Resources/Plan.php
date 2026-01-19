<?php

namespace Scwar\LaravelPaystack\Resources;

use Scwar\LaravelPaystack\Contracts\HttpClientInterface;
use Scwar\LaravelPaystack\DTOs\Requests\Plan\CreatePlanRequest;
use Scwar\LaravelPaystack\DTOs\Requests\Plan\UpdatePlanRequest;
use Scwar\LaravelPaystack\DTOs\Responses\Plan\PlanData;
use Scwar\LaravelPaystack\Support\Pagination;

class Plan extends BaseResource
{
    public function __construct(HttpClientInterface $client)
    {
        parent::__construct($client, 'plan');
    }

    /**
     * Create a plan.
     *
     * @param CreatePlanRequest|array $request
     * @return PlanData
     */
    public function create(CreatePlanRequest|array $request): PlanData
    {
        if (is_array($request)) {
            $request = CreatePlanRequest::fromArray($request);
        }

        $response = $this->client->post('/plan', $request->toArray());

        return PlanData::fromArray($this->extractData($response));
    }

    /**
     * List plans.
     *
     * @param array $query
     * @return array{data: array<PlanData>, pagination: Pagination|null}
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('/plan', $query);

        return [
            'data' => array_map(
                fn($item) => PlanData::fromArray($item),
                $this->extractData($response) ?? []
            ),
            'pagination' => $this->getPagination($response),
        ];
    }

    /**
     * Fetch a plan.
     *
     * @param string $idOrCode
     * @return PlanData
     */
    public function fetch(string $idOrCode): PlanData
    {
        $response = $this->client->get("/plan/{$idOrCode}");

        return PlanData::fromArray($this->extractData($response));
    }

    /**
     * Update a plan.
     *
     * @param string $idOrCode
     * @param UpdatePlanRequest|array $request
     * @return PlanData
     */
    public function update(string $idOrCode, UpdatePlanRequest|array $request): PlanData
    {
        if (is_array($request)) {
            $request = UpdatePlanRequest::fromArray($request);
        }

        $response = $this->client->put("/plan/{$idOrCode}", $request->toArray());

        return PlanData::fromArray($this->extractData($response));
    }
}
