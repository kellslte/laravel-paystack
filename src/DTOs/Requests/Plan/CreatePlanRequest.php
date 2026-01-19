<?php

namespace Scwar\LaravelPaystack\DTOs\Requests\Plan;

readonly class CreatePlanRequest
{
    public function __construct(
        public string $name,
        public int $amount,
        public string $interval,
        public ?string $description = null,
        public ?bool $sendInvoices = null,
        public ?bool $sendSms = null,
        public ?string $currency = null,
        public ?int $invoiceLimit = null,
        public ?array $metadata = null,
    ) {
    }

    public function toArray(): array
    {
        $data = [
            'name' => $this->name,
            'amount' => $this->amount,
            'interval' => $this->interval,
        ];

        if ($this->description !== null) {
            $data['description'] = $this->description;
        }

        if ($this->sendInvoices !== null) {
            $data['send_invoices'] = $this->sendInvoices;
        }

        if ($this->sendSms !== null) {
            $data['send_sms'] = $this->sendSms;
        }

        if ($this->currency !== null) {
            $data['currency'] = $this->currency;
        }

        if ($this->invoiceLimit !== null) {
            $data['invoice_limit'] = $this->invoiceLimit;
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
            amount: $data['amount'],
            interval: $data['interval'],
            description: $data['description'] ?? null,
            sendInvoices: $data['send_invoices'] ?? $data['sendInvoices'] ?? null,
            sendSms: $data['send_sms'] ?? $data['sendSms'] ?? null,
            currency: $data['currency'] ?? null,
            invoiceLimit: $data['invoice_limit'] ?? $data['invoiceLimit'] ?? null,
            metadata: $data['metadata'] ?? null,
        );
    }
}
