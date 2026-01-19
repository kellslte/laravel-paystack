<?php

namespace Scwar\LaravelPaystack\DTOs\Requests\Transaction;

readonly class ChargeAuthorizationRequest
{
    public function __construct(
        public string $authorizationCode,
        public string $email,
        public int $amount,
        public ?string $reference = null,
        public ?string $currency = null,
        public ?array $metadata = null,
        public ?string $splitCode = null,
        public ?array $subaccount = null,
        public ?int $transactionCharge = null,
        public ?string $bearer = null,
        public ?string $queue = null,
    ) {
    }

    /**
     * Convert to array for API request.
     *
     * @return array
     */
    public function toArray(): array
    {
        $data = [
            'authorization_code' => $this->authorizationCode,
            'email' => $this->email,
            'amount' => $this->amount,
        ];

        if ($this->reference !== null) {
            $data['reference'] = $this->reference;
        }

        if ($this->currency !== null) {
            $data['currency'] = $this->currency;
        }

        if ($this->metadata !== null) {
            $data['metadata'] = $this->metadata;
        }

        if ($this->splitCode !== null) {
            $data['split_code'] = $this->splitCode;
        }

        if ($this->subaccount !== null) {
            $data['subaccount'] = $this->subaccount;
        }

        if ($this->transactionCharge !== null) {
            $data['transaction_charge'] = $this->transactionCharge;
        }

        if ($this->bearer !== null) {
            $data['bearer'] = $this->bearer;
        }

        if ($this->queue !== null) {
            $data['queue'] = $this->queue;
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
            authorizationCode: $data['authorization_code'] ?? $data['authorizationCode'],
            email: $data['email'],
            amount: $data['amount'],
            reference: $data['reference'] ?? null,
            currency: $data['currency'] ?? null,
            metadata: $data['metadata'] ?? null,
            splitCode: $data['split_code'] ?? $data['splitCode'] ?? null,
            subaccount: $data['subaccount'] ?? null,
            transactionCharge: $data['transaction_charge'] ?? $data['transactionCharge'] ?? null,
            bearer: $data['bearer'] ?? null,
            queue: $data['queue'] ?? null,
        );
    }
}
