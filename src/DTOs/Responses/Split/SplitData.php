<?php

namespace Scwar\LaravelPaystack\DTOs\Responses\Split;

readonly class SplitData
{
    public function __construct(
        public int $id,
        public string $name,
        public string $type,
        public string $currency,
        public string $splitCode,
        public bool $active,
        public ?string $bearerType = null,
        public ?string $bearerSubaccount = null,
        public ?array $subaccounts = null,
        public ?float $totalVolume = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            type: $data['type'],
            currency: $data['currency'],
            splitCode: $data['split_code'],
            active: $data['active'] ?? true,
            bearerType: $data['bearer_type'] ?? null,
            bearerSubaccount: $data['bearer_subaccount'] ?? null,
            subaccounts: $data['subaccounts'] ?? null,
            totalVolume: $data['total_volume'] ?? null,
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
        );
    }
}
