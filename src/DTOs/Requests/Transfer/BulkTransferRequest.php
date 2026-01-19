<?php

namespace Scwar\LaravelPaystack\DTOs\Requests\Transfer;

readonly class BulkTransferRequest
{
    public function __construct(
        public string $currency,
        public string $source,
        public array $transfers,
    ) {
    }

    public function toArray(): array
    {
        return [
            'currency' => $this->currency,
            'source' => $this->source,
            'transfers' => $this->transfers,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            currency: $data['currency'],
            source: $data['source'],
            transfers: $data['transfers'],
        );
    }
}
