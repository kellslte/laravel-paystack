<?php

namespace Scwar\LaravelPaystack\DTOs\Responses\Product;

readonly class ProductData
{
    public function __construct(
        public int $id,
        public string $name,
        public ?string $description = null,
        public ?string $productCode = null,
        public ?int $price = null,
        public ?string $currency = null,
        public ?int $quantity = null,
        public ?int $quantitySold = null,
        public ?int $quantityAvailable = null,
        public ?string $type = null,
        public ?bool $shippable = null,
        public ?bool $unlimited = null,
        public ?array $metadata = null,
        public ?string $integration = null,
        public ?string $domain = null,
        public ?string $slug = null,
        public ?bool $active = null,
        public ?string $inStock = null,
        public ?int $stock = null,
        public ?string $image = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            description: $data['description'] ?? null,
            productCode: $data['product_code'] ?? null,
            price: $data['price'] ?? null,
            currency: $data['currency'] ?? null,
            quantity: $data['quantity'] ?? null,
            quantitySold: $data['quantity_sold'] ?? null,
            quantityAvailable: $data['quantity_available'] ?? null,
            type: $data['type'] ?? null,
            shippable: $data['shippable'] ?? null,
            unlimited: $data['unlimited'] ?? null,
            metadata: $data['metadata'] ?? null,
            integration: $data['integration'] ?? null,
            domain: $data['domain'] ?? null,
            slug: $data['slug'] ?? null,
            active: $data['active'] ?? null,
            inStock: $data['in_stock'] ?? null,
            stock: $data['stock'] ?? null,
            image: $data['image'] ?? null,
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
        );
    }
}
