<?php

namespace Scwar\LaravelPaystack\DTOs\Requests\Transaction;

readonly class InitializeTransactionRequest
{
    public function __construct(
        public int $amount,
        public string $email,
        public ?string $reference = null,
        public ?string $currency = null,
        public ?string $callbackUrl = null,
        public ?string $plan = null,
        public ?int $invoiceLimit = null,
        public ?array $metadata = null,
        public ?array $channels = null,
        public ?string $splitCode = null,
        public ?array $subaccount = null,
        public ?int $transactionCharge = null,
        public ?string $bearer = null,
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
            'amount' => $this->amount,
            'email' => $this->email,
        ];

        if ($this->reference !== null) {
            $data['reference'] = $this->reference;
        }

        if ($this->currency !== null) {
            $data['currency'] = $this->currency;
        }

        if ($this->callbackUrl !== null) {
            $data['callback_url'] = $this->callbackUrl;
        }

        if ($this->plan !== null) {
            $data['plan'] = $this->plan;
        }

        if ($this->invoiceLimit !== null) {
            $data['invoice_limit'] = $this->invoiceLimit;
        }

        if ($this->metadata !== null) {
            $data['metadata'] = $this->metadata;
        }

        if ($this->channels !== null) {
            $data['channels'] = $this->channels;
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
            amount: $data['amount'],
            email: $data['email'],
            reference: $data['reference'] ?? null,
            currency: $data['currency'] ?? null,
            callbackUrl: $data['callback_url'] ?? $data['callbackUrl'] ?? null,
            plan: $data['plan'] ?? null,
            invoiceLimit: $data['invoice_limit'] ?? $data['invoiceLimit'] ?? null,
            metadata: $data['metadata'] ?? null,
            channels: $data['channels'] ?? null,
            splitCode: $data['split_code'] ?? $data['splitCode'] ?? null,
            subaccount: $data['subaccount'] ?? null,
            transactionCharge: $data['transaction_charge'] ?? $data['transactionCharge'] ?? null,
            bearer: $data['bearer'] ?? null,
        );
    }
}
