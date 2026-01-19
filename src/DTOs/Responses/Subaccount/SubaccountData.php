<?php

namespace Scwar\LaravelPaystack\DTOs\Responses\Subaccount;

readonly class SubaccountData
{
    public function __construct(
        public int $id,
        public string $domain,
        public string $subaccountCode,
        public string $businessName,
        public string $description,
        public string $primaryContactEmail,
        public string $primaryContactName,
        public string $primaryContactPhone,
        public string $settlementBank,
        public string $accountNumber,
        public ?float $percentageCharge = null,
        public ?bool $isVerified = null,
        public ?string $settlementSchedule = null,
        public ?bool $active = null,
        public ?string $metadata = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            domain: $data['domain'],
            subaccountCode: $data['subaccount_code'],
            businessName: $data['business_name'],
            description: $data['description'],
            primaryContactEmail: $data['primary_contact_email'],
            primaryContactName: $data['primary_contact_name'],
            primaryContactPhone: $data['primary_contact_phone'],
            settlementBank: $data['settlement_bank'],
            accountNumber: $data['account_number'],
            percentageCharge: $data['percentage_charge'] ?? null,
            isVerified: $data['is_verified'] ?? null,
            settlementSchedule: $data['settlement_schedule'] ?? null,
            active: $data['active'] ?? null,
            metadata: $data['metadata'] ?? null,
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
        );
    }
}
