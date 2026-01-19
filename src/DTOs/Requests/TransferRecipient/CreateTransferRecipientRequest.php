<?php

namespace Scwar\LaravelPaystack\DTOs\Requests\TransferRecipient;

readonly class CreateTransferRecipientRequest
{
    public function __construct(
        public string $type,
        public string $name,
        public ?string $accountNumber = null,
        public ?string $bankCode = null,
        public ?string $currency = null,
        public ?string $description = null,
        public ?string $email = null,
        public ?array $metadata = null,
    ) {
    }

    public function toArray(): array
    {
        $data = [
            'type' => $this->type,
            'name' => $this->name,
        ];

        if ($this->accountNumber !== null) {
            $data['account_number'] = $this->accountNumber;
        }

        if ($this->bankCode !== null) {
            $data['bank_code'] = $this->bankCode;
        }

        if ($this->currency !== null) {
            $data['currency'] = $this->currency;
        }

        if ($this->description !== null) {
            $data['description'] = $this->description;
        }

        if ($this->email !== null) {
            $data['email'] = $this->email;
        }

        if ($this->metadata !== null) {
            $data['metadata'] = $this->metadata;
        }

        return $data;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            type: $data['type'],
            name: $data['name'],
            accountNumber: $data['account_number'] ?? $data['accountNumber'] ?? null,
            bankCode: $data['bank_code'] ?? $data['bankCode'] ?? null,
            currency: $data['currency'] ?? null,
            description: $data['description'] ?? null,
            email: $data['email'] ?? null,
            metadata: $data['metadata'] ?? null,
        );
    }
}
