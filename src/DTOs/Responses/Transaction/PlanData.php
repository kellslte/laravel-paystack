<?php

namespace Scwar\LaravelPaystack\DTOs\Responses\Transaction;

readonly class PlanData
{
    public function __construct(
        public int $id,
        public ?string $name = null,
        public ?string $planCode = null,
        public ?string $description = null,
        public ?int $amount = null,
        public ?string $interval = null,
        public ?string $currency = null,
        public ?string $sendInvoices = null,
        public ?string $sendSms = null,
        public ?string $hostedPage = null,
        public ?string $hostedPageUrl = null,
        public ?string $hostedPageSummary = null,
        public ?string $currencyCode = null,
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
            name: $data['name'] ?? null,
            planCode: $data['plan_code'] ?? null,
            description: $data['description'] ?? null,
            amount: $data['amount'] ?? null,
            interval: $data['interval'] ?? null,
            currency: $data['currency'] ?? null,
            sendInvoices: $data['send_invoices'] ?? null,
            sendSms: $data['send_sms'] ?? null,
            hostedPage: $data['hosted_page'] ?? null,
            hostedPageUrl: $data['hosted_page_url'] ?? null,
            hostedPageSummary: $data['hosted_page_summary'] ?? null,
            currencyCode: $data['currency_code'] ?? null,
        );
    }
}
