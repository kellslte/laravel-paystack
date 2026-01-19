<?php

namespace Scwar\LaravelPaystack\DTOs\Requests\VirtualAccount;

readonly class CreateDedicatedAccountRequest
{
    public function __construct(
        public string $customer,
        public ?string $preferredBank = null,
        public ?string $subaccount = null,
        public ?string $splitCode = null,
        public ?string $firstname = null,
        public ?string $lastname = null,
        public ?string $phone = null,
    ) {
    }

    public function toArray(): array
    {
        $data = ['customer' => $this->customer];

        if ($this->preferredBank !== null) {
            $data['preferred_bank'] = $this->preferredBank;
        }

        if ($this->subaccount !== null) {
            $data['subaccount'] = $this->subaccount;
        }

        if ($this->splitCode !== null) {
            $data['split_code'] = $this->splitCode;
        }

        if ($this->firstname !== null) {
            $data['firstname'] = $this->firstname;
        }

        if ($this->lastname !== null) {
            $data['lastname'] = $this->lastname;
        }

        if ($this->phone !== null) {
            $data['phone'] = $this->phone;
        }

        return $data;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            customer: $data['customer'],
            preferredBank: $data['preferred_bank'] ?? $data['preferredBank'] ?? null,
            subaccount: $data['subaccount'] ?? null,
            splitCode: $data['split_code'] ?? $data['splitCode'] ?? null,
            firstname: $data['firstname'] ?? null,
            lastname: $data['lastname'] ?? null,
            phone: $data['phone'] ?? null,
        );
    }
}
