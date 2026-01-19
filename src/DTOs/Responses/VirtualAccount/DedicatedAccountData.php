<?php

namespace Scwar\LaravelPaystack\DTOs\Responses\VirtualAccount;

readonly class DedicatedAccountData
{
    public function __construct(
        public int $id,
        public string $domain,
        public string $dedicatedNuban,
        public string $dedicatedNubanSerial,
        public string $bank,
        public string $bankName,
        public string $accountName,
        public string $accountNumber,
        public string $currency,
        public ?string $customer = null,
        public ?object $customerObject = null,
        public ?string $split = null,
        public ?object $splitObject = null,
        public ?string $subaccount = null,
        public ?object $subaccountObject = null,
        public ?bool $active = null,
        public ?string $assigned = null,
        public ?string $assignment = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            domain: $data['domain'],
            dedicatedNuban: $data['dedicated_nuban'],
            dedicatedNubanSerial: $data['dedicated_nuban_serial'],
            bank: $data['bank'],
            bankName: $data['bank_name'],
            accountName: $data['account_name'],
            accountNumber: $data['account_number'],
            currency: $data['currency'],
            customer: $data['customer'] ?? null,
            customerObject: isset($data['customer_object']) ? (object) $data['customer_object'] : null,
            split: $data['split'] ?? null,
            splitObject: isset($data['split_object']) ? (object) $data['split_object'] : null,
            subaccount: $data['subaccount'] ?? null,
            subaccountObject: isset($data['subaccount_object']) ? (object) $data['subaccount_object'] : null,
            active: $data['active'] ?? null,
            assigned: $data['assigned'] ?? null,
            assignment: $data['assignment'] ?? null,
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
        );
    }
}
