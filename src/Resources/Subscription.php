<?php

namespace Scwar\LaravelPaystack\Resources;

use Scwar\LaravelPaystack\Contracts\HttpClientInterface;
use Scwar\LaravelPaystack\Support\Pagination;

class Subscription extends BaseResource
{
    public function __construct(HttpClientInterface $client)
    {
        parent::__construct($client, 'subscription');
    }

    /**
     * Create a subscription.
     *
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        return $this->client->post('/subscription', $data);
    }

    /**
     * List subscriptions.
     *
     * @param array $query
     * @return array{data: array, pagination: Pagination|null}
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('/subscription', $query);

        return [
            'data' => $this->extractData($response) ?? [],
            'pagination' => $this->getPagination($response),
        ];
    }

    /**
     * Fetch a subscription.
     *
     * @param string $idOrCode
     * @return array
     */
    public function fetch(string $idOrCode): array
    {
        $response = $this->client->get("/subscription/{$idOrCode}");

        return $this->extractData($response);
    }

    /**
     * Enable a subscription.
     *
     * @param string $code
     * @param string $token
     * @return array
     */
    public function enable(string $code, string $token): array
    {
        return $this->client->post("/subscription/enable", [
            'code' => $code,
            'token' => $token,
        ]);
    }

    /**
     * Disable a subscription.
     *
     * @param string $code
     * @param string $token
     * @return array
     */
    public function disable(string $code, string $token): array
    {
        return $this->client->post("/subscription/disable", [
            'code' => $code,
            'token' => $token,
        ]);
    }

    /**
     * Generate update subscription link.
     *
     * @param string $code
     * @return array
     */
    public function generateUpdateLink(string $code): array
    {
        return $this->client->post("/subscription/{$code}/manage/link");
    }
}
