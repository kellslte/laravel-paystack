<?php

namespace Scwar\LaravelPaystack\Resources;

use Scwar\LaravelPaystack\Contracts\HttpClientInterface;
use Scwar\LaravelPaystack\DTOs\Requests\Transaction\ChargeAuthorizationRequest;
use Scwar\LaravelPaystack\DTOs\Requests\Transaction\InitializeTransactionRequest;
use Scwar\LaravelPaystack\DTOs\Responses\Transaction\InitializeTransactionResponse;
use Scwar\LaravelPaystack\DTOs\Responses\Transaction\TransactionData;
use Scwar\LaravelPaystack\Support\Pagination;

class Transaction extends BaseResource
{
    public function __construct(HttpClientInterface $client)
    {
        parent::__construct($client, 'transaction');
    }

    /**
     * Initialize a transaction.
     *
     * @param InitializeTransactionRequest|array $request
     * @return InitializeTransactionResponse
     */
    public function initialize(InitializeTransactionRequest|array $request): InitializeTransactionResponse
    {
        if (is_array($request)) {
            $request = InitializeTransactionRequest::fromArray($request);
        }

        $response = $this->client->post('/transaction/initialize', $request->toArray());

        return InitializeTransactionResponse::fromArray($response);
    }

    /**
     * Verify a transaction.
     *
     * @param string $reference
     * @return TransactionData
     */
    public function verify(string $reference): TransactionData
    {
        $response = $this->client->get("/transaction/verify/{$reference}", []);

        return TransactionData::fromArray($this->extractData($response));
    }

    /**
     * List transactions.
     *
     * @param array $query
     * @return array{data: array, pagination: Pagination|null}
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('/transaction', $query);

        return [
            'data' => array_map(
                fn($item) => TransactionData::fromArray($item),
                $this->extractData($response) ?? []
            ),
            'pagination' => $this->getPagination($response),
        ];
    }

    /**
     * Fetch a transaction.
     *
     * @param int|string $id
     * @return TransactionData
     */
    public function fetch(int|string $id): TransactionData
    {
        $response = $this->client->get("/transaction/{$id}");

        return TransactionData::fromArray($this->extractData($response));
    }

    /**
     * Charge an authorization.
     *
     * @param ChargeAuthorizationRequest|array $request
     * @return TransactionData
     */
    public function chargeAuthorization(ChargeAuthorizationRequest|array $request): TransactionData
    {
        if (is_array($request)) {
            $request = ChargeAuthorizationRequest::fromArray($request);
        }

        $response = $this->client->post('/transaction/charge_authorization', $request->toArray());

        return TransactionData::fromArray($this->extractData($response));
    }

    /**
     * Get transaction totals.
     *
     * @param array $query
     * @return array
     */
    public function totals(array $query = []): array
    {
        return $this->client->get('/transaction/totals', $query);
    }

    /**
     * Export transactions.
     *
     * @param array $query
     * @return array
     */
    public function export(array $query = []): array
    {
        return $this->client->get('/transaction/export', $query);
    }

    /**
     * Get transaction timeline.
     *
     * @param string $idOrReference
     * @return array
     */
    public function timeline(string $idOrReference): array
    {
        return $this->client->get("/transaction/timeline/{$idOrReference}");
    }
}
