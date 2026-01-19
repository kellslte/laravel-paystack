<?php

namespace Scwar\LaravelPaystack\DTOs\Responses\TransferRecipient;

readonly class TransferRecipientData
{
    public function __construct(
        public bool $active,
        public int $id,
        public string $type,
        public string $name,
        public string $currency,
        public string $recipientCode,
        public ?string $accountNumber = null,
        public ?string $bankCode = null,
        public ?string $bankName = null,
        public ?string $description = null,
        public ?string $email = null,
        public ?array $metadata = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            active: $data['active'] ?? true,
            id: $data['id'],
            type: $data['type'],
            name: $data['name'],
            currency: $data['currency'],
            recipientCode: $data['recipient_code'],
            accountNumber: $data['account_number'] ?? null,
            bankCode: $data['bank_code'] ?? null,
            bankName: $data['bank_name'] ?? null,
            description: $data['description'] ?? null,
            email: $data['email'] ?? null,
            metadata: $data['metadata'] ?? null,
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
        );
    }
}
