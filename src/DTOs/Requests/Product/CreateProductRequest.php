<?php

namespace Scwar\LaravelPaystack\DTOs\Requests\Product;

readonly class CreateProductRequest
{
    public function __construct(
        public string $name,
        public ?string $description = null,
        public ?int $price = null,
        public ?string $currency = null,
        public ?bool $limited = null,
        public ?int $quantity = null,
        public ?array $metadata = null,
    ) {
    }

    public function toArray(): array
    {
        $data = ['name' => $this->name];

        if ($this->description !== null) {
            $data['description'] = $this->description;
        }

        if ($this->price !== null) {
            $data['price'] = $this->price;
        }

        if ($this->currency !== null) {
            $data['currency'] = $this->currency;
        }

        if ($this->limited !== null) {
            $data['limited'] = $this->limited;
        }

        if ($this->quantity !== null) {
            $data['quantity'] = $this->quantity;
        }

        if ($this->metadata !== null) {
            $data['metadata'] = $this->metadata;
        }

        return $data;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            description: $data['description'] ?? null,
            price: $data['price'] ?? null,
            currency: $data['currency'] ?? null,
            limited: $data['limited'] ?? null,
            quantity: $data['quantity'] ?? null,
            metadata: $data['metadata'] ?? null,
        );
    }
}
