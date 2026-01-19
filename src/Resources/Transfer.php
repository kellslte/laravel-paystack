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
     * @param \Scwar\LaravelPaystack\DTOs\Requests\Transfer\InitiateTransferRequest|array $request
     * @return \Scwar\LaravelPaystack\DTOs\Responses\Transfer\TransferData
     */
    public function initiate(\Scwar\LaravelPaystack\DTOs\Requests\Transfer\InitiateTransferRequest|array $request): \Scwar\LaravelPaystack\DTOs\Responses\Transfer\TransferData
    {
        if (is_array($request)) {
            $request = \Scwar\LaravelPaystack\DTOs\Requests\Transfer\InitiateTransferRequest::fromArray($request);
        }

        $response = $this->client->post('/transfer', $request->toArray());

        return \Scwar\LaravelPaystack\DTOs\Responses\Transfer\TransferData::fromArray($this->extractData($response));
    }

    /**
     * List transfers.
     *
     * @param array $query
     * @return array{data: array<\Scwar\LaravelPaystack\DTOs\Responses\Transfer\TransferData>, pagination: Pagination|null}
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('/transfer', $query);

        return [
            'data' => array_map(
                fn($item) => \Scwar\LaravelPaystack\DTOs\Responses\Transfer\TransferData::fromArray($item),
                $this->extractData($response) ?? []
            ),
            'pagination' => $this->getPagination($response),
        ];
    }

    /**
     * Fetch a transfer.
     *
     * @param string $idOrCode
     * @return \Scwar\LaravelPaystack\DTOs\Responses\Transfer\TransferData
     */
    public function fetch(string $idOrCode): \Scwar\LaravelPaystack\DTOs\Responses\Transfer\TransferData
    {
        $response = $this->client->get("/transfer/{$idOrCode}");

        return \Scwar\LaravelPaystack\DTOs\Responses\Transfer\TransferData::fromArray($this->extractData($response));
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
     * @param \Scwar\LaravelPaystack\DTOs\Requests\Transfer\BulkTransferRequest|array $request
     * @return array
     */
    public function bulk(\Scwar\LaravelPaystack\DTOs\Requests\Transfer\BulkTransferRequest|array $request): array
    {
        if (is_array($request)) {
            $request = \Scwar\LaravelPaystack\DTOs\Requests\Transfer\BulkTransferRequest::fromArray($request);
        }

        return $this->client->post('/transfer/bulk', $request->toArray());
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
