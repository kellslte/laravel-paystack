<?php

namespace Scwar\LaravelPaystack\DTOs\Responses\Transaction;

readonly class SplitData
{
    public function __construct(
        public ?string $splitCode = null,
        public ?string $splitName = null,
        public ?float $totalVolume = null,
        public ?string $currency = null,
        public ?int $active = null,
        public ?string $bearerType = null,
        public ?int $bearerSubaccount = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?array $subaccounts = null,
    ) {
    }

    /**
     * Create from array.
     *
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            splitCode: $data['split_code'] ?? null,
            splitName: $data['split_name'] ?? null,
            totalVolume: $data['total_volume'] ?? null,
            currency: $data['currency'] ?? null,
            active: $data['active'] ?? null,
            bearerType: $data['bearer_type'] ?? null,
            bearerSubaccount: $data['bearer_subaccount'] ?? null,
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
            subaccounts: $data['subaccounts'] ?? null,
        );
    }
}
