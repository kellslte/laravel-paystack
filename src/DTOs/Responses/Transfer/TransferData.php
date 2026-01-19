<?php

namespace Scwar\LaravelPaystack\DTOs\Responses\Transfer;

readonly class TransferData
{
    public function __construct(
        public int $id,
        public string $domain,
        public string $status,
        public string $transferCode,
        public int $amount,
        public string $currency,
        public ?string $recipient = null,
        public ?object $recipientObject = null,
        public ?string $source = null,
        public ?string $reason = null,
        public ?string $reference = null,
        public ?int $failures = null,
        public ?string $transferNote = null,
        public ?string $titanCode = null,
        public ?string $transferredAt = null,
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
            transferCode: $data['transfer_code'],
            amount: $data['amount'],
            currency: $data['currency'],
            recipient: $data['recipient'] ?? null,
            recipientObject: isset($data['recipient_object']) ? (object) $data['recipient_object'] : null,
            source: $data['source'] ?? null,
            reason: $data['reason'] ?? null,
            reference: $data['reference'] ?? null,
            failures: $data['failures'] ?? null,
            transferNote: $data['transfer_note'] ?? null,
            titanCode: $data['titan_code'] ?? null,
            transferredAt: $data['transferred_at'] ?? null,
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
        );
    }
}
