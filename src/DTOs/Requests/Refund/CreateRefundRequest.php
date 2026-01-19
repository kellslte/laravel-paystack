<?php

namespace Scwar\LaravelPaystack\DTOs\Requests\Refund;

readonly class CreateRefundRequest
{
    public function __construct(
        public string $transaction,
        public ?int $amount = null,
        public ?string $currency = null,
        public ?string $customerNote = null,
        public ?string $merchantNote = null,
    ) {
    }

    public function toArray(): array
    {
        $data = [
            'transaction' => $this->transaction,
        ];

        if ($this->amount !== null) {
            $data['amount'] = $this->amount;
        }

        if ($this->currency !== null) {
            $data['currency'] = $this->currency;
        }

        if ($this->customerNote !== null) {
            $data['customer_note'] = $this->customerNote;
        }

        if ($this->merchantNote !== null) {
            $data['merchant_note'] = $this->merchantNote;
        }

        return $data;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            transaction: $data['transaction'],
            amount: $data['amount'] ?? null,
            currency: $data['currency'] ?? null,
            customerNote: $data['customer_note'] ?? $data['customerNote'] ?? null,
            merchantNote: $data['merchant_note'] ?? $data['merchantNote'] ?? null,
        );
    }
}
