<?php

namespace Scwar\LaravelPaystack\Resources;

use Scwar\LaravelPaystack\Contracts\HttpClientInterface;
use Scwar\LaravelPaystack\DTOs\Requests\Subscription\CreateSubscriptionRequest;
use Scwar\LaravelPaystack\DTOs\Responses\Subscription\SubscriptionData;
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
     * @param CreateSubscriptionRequest|array $request
     * @return SubscriptionData
     */
    public function create(CreateSubscriptionRequest|array $request): SubscriptionData
    {
        if (is_array($request)) {
            $request = CreateSubscriptionRequest::fromArray($request);
        }

        $response = $this->client->post('/subscription', $request->toArray());

        return SubscriptionData::fromArray($this->extractData($response));
    }

    /**
     * List subscriptions.
     *
     * @param array $query
     * @return array{data: array<SubscriptionData>, pagination: Pagination|null}
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('/subscription', $query);

        return [
            'data' => array_map(
                fn($item) => SubscriptionData::fromArray($item),
                $this->extractData($response) ?? []
            ),
            'pagination' => $this->getPagination($response),
        ];
    }

    /**
     * Fetch a subscription.
     *
     * @param string $idOrCode
     * @return SubscriptionData
     */
    public function fetch(string $idOrCode): SubscriptionData
    {
        $response = $this->client->get("/subscription/{$idOrCode}");

        return SubscriptionData::fromArray($this->extractData($response));
    }

    /**
     * Enable a subscription.
     *
     * @param string $code
     * @param string $token
     * @return SubscriptionData
     */
    public function enable(string $code, string $token): SubscriptionData
    {
        $response = $this->client->post("/subscription/enable", [
            'code' => $code,
            'token' => $token,
        ]);

        return SubscriptionData::fromArray($this->extractData($response));
    }

    /**
     * Disable a subscription.
     *
     * @param string $code
     * @param string $token
     * @return SubscriptionData
     */
    public function disable(string $code, string $token): SubscriptionData
    {
        $response = $this->client->post("/subscription/disable", [
            'code' => $code,
            'token' => $token,
        ]);

        return SubscriptionData::fromArray($this->extractData($response));
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
