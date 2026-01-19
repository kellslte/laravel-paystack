<?php

namespace Scwar\LaravelPaystack\DTOs\Responses\Dispute;

readonly class DisputeData
{
    public function __construct(
        public int $id,
        public string $domain,
        public string $status,
        public string $transaction,
        public ?object $transactionObject = null,
        public ?string $category = null,
        public ?string $disputeType = null,
        public ?string $currency = null,
        public ?int $amount = null,
        public ?string $resolvedAt = null,
        public ?string $customer = null,
        public ?object $customerObject = null,
        public ?string $reason = null,
        public ?string $source = null,
        public ?array $metadata = null,
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
            transactionObject: isset($data['transaction_object']) ? (object) $data['transaction_object'] : null,
            category: $data['category'] ?? null,
            disputeType: $data['dispute_type'] ?? null,
            currency: $data['currency'] ?? null,
            amount: $data['amount'] ?? null,
            resolvedAt: $data['resolved_at'] ?? null,
            customer: $data['customer'] ?? null,
            customerObject: isset($data['customer_object']) ? (object) $data['customer_object'] : null,
            reason: $data['reason'] ?? null,
            source: $data['source'] ?? null,
            metadata: $data['metadata'] ?? null,
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
        );
    }
}
