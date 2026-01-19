<?php

namespace Scwar\LaravelPaystack\DTOs\Responses\Refund;

readonly class RefundData
{
    public function __construct(
        public int $id,
        public string $domain,
        public string $status,
        public string $transaction,
        public int $amount,
        public string $currency,
        public ?string $customerNote = null,
        public ?string $merchantNote = null,
        public ?string $refundedAt = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            domain: $data['domain'],
            status: $data['status'],
            transaction: $data['transaction'],
            amount: $data['amount'],
            currency: $data['currency'],
            customerNote: $data['customer_note'] ?? null,
            merchantNote: $data['merchant_note'] ?? null,
            refundedAt: $data['refunded_at'] ?? null,
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
        );
    }
}
