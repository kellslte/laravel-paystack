<?php

namespace Scwar\LaravelPaystack\DTOs\Requests\Split;

readonly class CreateSplitRequest
{
    public function __construct(
        public string $name,
        public string $type,
        public string $currency,
        public array $subaccounts,
        public ?string $bearerType = null,
        public ?string $bearerSubaccount = null,
    ) {
    }

    public function toArray(): array
    {
        $data = [
            'name' => $this->name,
            'type' => $this->type,
            'currency' => $this->currency,
            'subaccounts' => $this->subaccounts,
        ];

        if ($this->bearerType !== null) {
            $data['bearer_type'] = $this->bearerType;
        }

        if ($this->bearerSubaccount !== null) {
            $data['bearer_subaccount'] = $this->bearerSubaccount;
        }

        return $data;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            type: $data['type'],
            currency: $data['currency'],
            subaccounts: $data['subaccounts'],
            bearerType: $data['bearer_type'] ?? $data['bearerType'] ?? null,
            bearerSubaccount: $data['bearer_subaccount'] ?? $data['bearerSubaccount'] ?? null,
        );
    }
}
