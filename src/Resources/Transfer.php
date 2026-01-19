<?php

namespace Scwar\LaravelPaystack\Resources;

use Scwar\LaravelPaystack\Contracts\HttpClientInterface;
use Scwar\LaravelPaystack\Support\Pagination;

class Transfer extends BaseResource
{
    public function __construct(HttpClientInterface $client)
    {
        parent::__construct($client, 'transfer');
    }

    /**
     * Initiate a transfer.
     *
     * @param array $data
     * @return array
     */
    public function initiate(array $data): array
    {
        return $this->client->post('/transfer', $data);
    }

    /**
     * List transfers.
     *
     * @param array $query
     * @return array{data: array, pagination: Pagination|null}
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('/transfer', $query);

        return [
            'data' => $this->extractData($response) ?? [],
            'pagination' => $this->getPagination($response),
        ];
    }

    /**
     * Fetch a transfer.
     *
     * @param string $idOrCode
     * @return array
     */
    public function fetch(string $idOrCode): array
    {
        $response = $this->client->get("/transfer/{$idOrCode}");

        return $this->extractData($response);
    }

    /**
     * Finalize a transfer.
     *
     * @param array $data
     * @return array
     */
    public function finalize(array $data): array
    {
        return $this->client->post('/transfer/finalize_transfer', $data);
    }

    /**
     * Initiate bulk transfer.
     *
     * @param array $data
     * @return array
     */
    public function bulk(array $data): array
    {
        return $this->client->post('/transfer/bulk', $data);
    }

    /**
     * Verify a transfer.
     *
     * @param string $reference
     * @return array
     */
    public function verify(string $reference): array
    {
        $response = $this->client->get("/transfer/verify/{$reference}");

        return $this->extractData($response);
    }

    /**
     * Resend transfer OTP.
     *
     * @param array $data
     * @return array
     */
    public function resendOtp(array $data): array
    {
        return $this->client->post('/transfer/resend_otp', $data);
    }

    /**
     * Disable OTP requirement.
     *
     * @return array
     */
    public function disableOtp(): array
    {
        return $this->client->post('/transfer/disable_otp');
    }

    /**
     * Enable OTP requirement.
     *
     * @param array $data
     * @return array
     */
    public function enableOtp(array $data): array
    {
        return $this->client->post('/transfer/enable_otp', $data);
    }
}
