<?php

namespace Scwar\LaravelPaystack\Resources;

use Scwar\LaravelPaystack\Contracts\HttpClientInterface;
use Scwar\LaravelPaystack\Support\Pagination;

class Invoice extends BaseResource
{
    public function __construct(HttpClientInterface $client)
    {
        parent::__construct($client, 'invoice');
    }

    /**
     * Create an invoice.
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
     * List invoices.
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
     * Fetch an invoice.
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
     * Update an invoice.
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
     * Verify an invoice.
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
     * Send notification for an invoice.
     *
     * @param string $code
     * @return array
     */
    public function sendNotification(string $code): array
    {
        return $this->client->post("/paymentrequest/notify/{$code}");
    }

    /**
     * Finalize an invoice.
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
     * Archive an invoice.
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
