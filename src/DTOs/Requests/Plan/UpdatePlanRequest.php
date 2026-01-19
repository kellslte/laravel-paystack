<?php

namespace Scwar\LaravelPaystack\DTOs\Requests\Plan;

readonly class UpdatePlanRequest
{
    public function __construct(
        public ?string $name = null,
        public ?int $amount = null,
        public ?string $interval = null,
        public ?string $description = null,
        public ?bool $sendInvoices = null,
        public ?bool $sendSms = null,
        public ?string $currency = null,
        public ?int $invoiceLimit = null,
        public ?bool $updateExistingSubscriptions = null,
    ) {
    }

    public function toArray(): array
    {
        $data = [];

        if ($this->name !== null) {
            $data['name'] = $this->name;
        }

        if ($this->amount !== null) {
            $data['amount'] = $this->amount;
        }

        if ($this->interval !== null) {
            $data['interval'] = $this->interval;
        }

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

        if ($this->updateExistingSubscriptions !== null) {
            $data['update_existing_subscriptions'] = $this->updateExistingSubscriptions;
        }

        return $data;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            amount: $data['amount'] ?? null,
            interval: $data['interval'] ?? null,
            description: $data['description'] ?? null,
            sendInvoices: $data['send_invoices'] ?? $data['sendInvoices'] ?? null,
            sendSms: $data['send_sms'] ?? $data['sendSms'] ?? null,
            currency: $data['currency'] ?? null,
            invoiceLimit: $data['invoice_limit'] ?? $data['invoiceLimit'] ?? null,
            updateExistingSubscriptions: $data['update_existing_subscriptions'] ?? $data['updateExistingSubscriptions'] ?? null,
        );
    }
}
