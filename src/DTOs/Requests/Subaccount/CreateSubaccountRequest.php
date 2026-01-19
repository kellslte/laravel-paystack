<?php

namespace Scwar\LaravelPaystack\DTOs\Requests\Subaccount;

readonly class CreateSubaccountRequest
{
    public function __construct(
        public string $businessName,
        public string $settlementBank,
        public string $accountNumber,
        public ?float $percentageCharge = null,
        public ?string $description = null,
        public ?string $primaryContactEmail = null,
        public ?string $primaryContactName = null,
        public ?string $primaryContactPhone = null,
        public ?string $metadata = null,
    ) {
    }

    public function toArray(): array
    {
        $data = [
            'business_name' => $this->businessName,
            'settlement_bank' => $this->settlementBank,
            'account_number' => $this->accountNumber,
        ];

        if ($this->percentageCharge !== null) {
            $data['percentage_charge'] = $this->percentageCharge;
        }

        if ($this->description !== null) {
            $data['description'] = $this->description;
        }

        if ($this->primaryContactEmail !== null) {
            $data['primary_contact_email'] = $this->primaryContactEmail;
        }

        if ($this->primaryContactName !== null) {
            $data['primary_contact_name'] = $this->primaryContactName;
        }

        if ($this->primaryContactPhone !== null) {
            $data['primary_contact_phone'] = $this->primaryContactPhone;
        }

        if ($this->metadata !== null) {
            $data['metadata'] = $this->metadata;
        }

        return $data;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            businessName: $data['business_name'] ?? $data['businessName'],
            settlementBank: $data['settlement_bank'] ?? $data['settlementBank'],
            accountNumber: $data['account_number'] ?? $data['accountNumber'],
            percentageCharge: $data['percentage_charge'] ?? $data['percentageCharge'] ?? null,
            description: $data['description'] ?? null,
            primaryContactEmail: $data['primary_contact_email'] ?? $data['primaryContactEmail'] ?? null,
            primaryContactName: $data['primary_contact_name'] ?? $data['primaryContactName'] ?? null,
            primaryContactPhone: $data['primary_contact_phone'] ?? $data['primaryContactPhone'] ?? null,
            metadata: $data['metadata'] ?? null,
        );
    }
}
