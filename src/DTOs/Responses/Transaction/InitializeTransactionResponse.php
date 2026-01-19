<?php

namespace Scwar\LaravelPaystack\DTOs\Responses\Transaction;

readonly class InitializeTransactionResponse
{
    public function __construct(
        public bool $status,
        public string $message,
        public InitializeTransactionData $data,
    ) {
    }

    /**
     * Create from array.
     *
     * @param array $response
     * @return self
     */
    public static function fromArray(array $response): self
    {
        return new self(
            status: $response['status'] ?? false,
            message: $response['message'] ?? '',
            data: InitializeTransactionData::fromArray($response['data'] ?? []),
        );
    }
}
