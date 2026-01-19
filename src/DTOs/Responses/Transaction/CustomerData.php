<?php

namespace Scwar\LaravelPaystack\DTOs\Responses\Transaction;

readonly class CustomerData
{
    public function __construct(
        public int $id,
        public ?string $firstName = null,
        public ?string $lastName = null,
        public ?string $email = null,
        public ?string $customerCode = null,
        public ?string $phone = null,
        public ?array $metadata = null,
        public ?string $riskAction = null,
        public ?string $internationalFormatPhone = null,
    ) {
    }

    /**
     * Create from array.
     *
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            firstName: $data['first_name'] ?? null,
            lastName: $data['last_name'] ?? null,
            email: $data['email'] ?? null,
            customerCode: $data['customer_code'] ?? null,
            phone: $data['phone'] ?? null,
            metadata: $data['metadata'] ?? null,
            riskAction: $data['risk_action'] ?? null,
            internationalFormatPhone: $data['international_format_phone'] ?? null,
        );
    }
}
