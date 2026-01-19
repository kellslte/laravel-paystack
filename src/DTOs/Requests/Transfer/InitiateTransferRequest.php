<?php

namespace Scwar\LaravelPaystack\DTOs\Requests\Transfer;

readonly class InitiateTransferRequest
{
    public function __construct(
        public string $source,
        public int $amount,
        public string $recipient,
        public ?string $reason = null,
        public ?string $reference = null,
        public ?string $currency = null,
    ) {
    }

    public function toArray(): array
    {
        $data = [
            'source' => $this->source,
            'amount' => $this->amount,
            'recipient' => $this->recipient,
        ];

        if ($this->reason !== null) {
            $data['reason'] = $this->reason;
        }

        if ($this->reference !== null) {
            $data['reference'] = $this->reference;
        }

        if ($this->currency !== null) {
            $data['currency'] = $this->currency;
        }

        return $data;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            source: $data['source'],
            amount: $data['amount'],
            recipient: $data['recipient'],
            reason: $data['reason'] ?? null,
            reference: $data['reference'] ?? null,
            currency: $data['currency'] ?? null,
        );
    }
}
