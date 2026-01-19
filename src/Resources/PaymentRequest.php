<?php

namespace Scwar\LaravelPaystack\Resources;

use Scwar\LaravelPaystack\Contracts\HttpClientInterface;
use Scwar\LaravelPaystack\Support\Pagination;

class PaymentRequest extends BaseResource
{
    public function __construct(HttpClientInterface $client)
    {
        parent::__construct($client, 'paymentrequest');
    }

    /**
     * Create a payment request.
     *
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        $response = $this->client->post('/paymentrequest', $data);

        return $this->extractData($response);
    }

    /**
     * List payment requests.
     *
     * @param array $query
     * @return array{data: array, pagination: Pagination|null}
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('/paymentrequest', $query);

        return [
            'data' => $this->extractData($response) ?? [],
            'pagination' => $this->getPagination($response),
        ];
    }

    /**
     * Fetch a payment request.
     *
     * @param string $idOrCode
     * @return array
     */
    public function fetch(string $idOrCode): array
    {
        $response = $this->client->get("/paymentrequest/{$idOrCode}");

        return $this->extractData($response);
    }

    /**
     * Update a payment request.
     *
     * @param string $idOrCode
     * @param array $data
     * @return array
     */
    public function update(string $idOrCode, array $data): array
    {
        $response = $this->client->put("/paymentrequest/{$idOrCode}", $data);

        return $this->extractData($response);
    }

    /**
     * Verify a payment request.
     *
     * @param string $code
     * @return array
     */
    public function verify(string $code): array
    {
        $response = $this->client->get("/paymentrequest/verify/{$code}");

        return $this->extractData($response);
    }

    /**
     * Send notification for a payment request.
     *
     * @param string $code
     * @return array
     */
    public function sendNotification(string $code): array
    {
        return $this->client->post("/paymentrequest/notify/{$code}");
    }

    /**
     * Finalize a payment request.
     *
     * @param string $code
     * @param array $data
     * @return array
     */
    public function finalize(string $code, array $data): array
    {
        $response = $this->client->post("/paymentrequest/finalize/{$code}", $data);

        return $this->extractData($response);
    }

    /**
     * Archive a payment request.
     *
     * @param string $code
     * @return array
     */
    public function archive(string $code): array
    {
        $response = $this->client->post("/paymentrequest/archive/{$code}");

        return $this->extractData($response);
    }
}
