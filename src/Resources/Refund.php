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
     * @param \Scwar\LaravelPaystack\DTOs\Requests\Refund\CreateRefundRequest|array $request
     * @return \Scwar\LaravelPaystack\DTOs\Responses\Refund\RefundData
     */
    public function create(\Scwar\LaravelPaystack\DTOs\Requests\Refund\CreateRefundRequest|array $request): \Scwar\LaravelPaystack\DTOs\Responses\Refund\RefundData
    {
        if (is_array($request)) {
            $request = \Scwar\LaravelPaystack\DTOs\Requests\Refund\CreateRefundRequest::fromArray($request);
        }

        $response = $this->client->post('/refund', $request->toArray());

        return \Scwar\LaravelPaystack\DTOs\Responses\Refund\RefundData::fromArray($this->extractData($response));
    }

    /**
     * List refunds.
     *
     * @param array $query
     * @return array{data: array<\Scwar\LaravelPaystack\DTOs\Responses\Refund\RefundData>, pagination: Pagination|null}
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('/refund', $query);

        return [
            'data' => array_map(
                fn($item) => \Scwar\LaravelPaystack\DTOs\Responses\Refund\RefundData::fromArray($item),
                $this->extractData($response) ?? []
            ),
            'pagination' => $this->getPagination($response),
        ];
    }

    /**
     * Fetch a refund.
     *
     * @param string $idOrReference
     * @return \Scwar\LaravelPaystack\DTOs\Responses\Refund\RefundData
     */
    public function fetch(string $idOrReference): \Scwar\LaravelPaystack\DTOs\Responses\Refund\RefundData
    {
        $response = $this->client->get("/refund/{$idOrReference}");

        return \Scwar\LaravelPaystack\DTOs\Responses\Refund\RefundData::fromArray($this->extractData($response));
    }
}
