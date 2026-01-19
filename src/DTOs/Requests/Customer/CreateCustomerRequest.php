<?php

namespace Scwar\LaravelPaystack\DTOs\Requests\Customer;

readonly class CreateCustomerRequest
{
    public function __construct(
        public string $email,
        public ?string $firstName = null,
        public ?string $lastName = null,
        public ?string $phone = null,
        public ?array $metadata = null,
    ) {
    }

    /**
     * Convert to array for API request.
     *
     * @return array
     */
    public function toArray(): array
    {
        $data = ['email' => $this->email];

        if ($this->firstName !== null) {
            $data['first_name'] = $this->firstName;
        }

        if ($this->lastName !== null) {
            $data['last_name'] = $this->lastName;
        }

        if ($this->phone !== null) {
            $data['phone'] = $this->phone;
        }

        if ($this->metadata !== null) {
            $data['metadata'] = $this->metadata;
        }

        return $data;
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
            email: $data['email'],
            firstName: $data['first_name'] ?? $data['firstName'] ?? null,
            lastName: $data['last_name'] ?? $data['lastName'] ?? null,
            phone: $data['phone'] ?? null,
            metadata: $data['metadata'] ?? null,
        );
    }
}
