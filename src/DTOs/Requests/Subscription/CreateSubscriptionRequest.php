<?php

namespace Scwar\LaravelPaystack\DTOs\Requests\Subscription;

readonly class CreateSubscriptionRequest
{
    public function __construct(
        public string $customer,
        public string $plan,
        public ?string $authorization = null,
        public ?string $startDate = null,
        public ?bool $sendInvoice = null,
        public ?bool $sendSms = null,
        public ?string $currency = null,
    ) {
    }

    public function toArray(): array
    {
        $data = [
            'customer' => $this->customer,
            'plan' => $this->plan,
        ];

        if ($this->authorization !== null) {
            $data['authorization'] = $this->authorization;
        }

        if ($this->startDate !== null) {
            $data['start_date'] = $this->startDate;
        }

        if ($this->sendInvoice !== null) {
            $data['send_invoice'] = $this->sendInvoice;
        }

        if ($this->sendSms !== null) {
            $data['send_sms'] = $this->sendSms;
        }

        if ($this->currency !== null) {
            $data['currency'] = $this->currency;
        }

        return $data;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            customer: $data['customer'],
            plan: $data['plan'],
            authorization: $data['authorization'] ?? null,
            startDate: $data['start_date'] ?? $data['startDate'] ?? null,
            sendInvoice: $data['send_invoice'] ?? $data['sendInvoice'] ?? null,
            sendSms: $data['send_sms'] ?? $data['sendSms'] ?? null,
            currency: $data['currency'] ?? null,
        );
    }
}
