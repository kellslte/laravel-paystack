<?php

namespace Scwar\LaravelPaystack\DTOs\Responses\Plan;

readonly class PlanData
{
    public function __construct(
        public int $id,
        public string $name,
        public string $planCode,
        public string $description,
        public int $amount,
        public string $interval,
        public ?bool $sendInvoices = null,
        public ?bool $sendSms = null,
        public ?string $currency = null,
        public ?string $currencyCode = null,
        public ?int $invoiceLimit = null,
        public ?array $metadata = null,
        public ?string $hostedPage = null,
        public ?string $hostedPageUrl = null,
        public ?string $hostedPageSummary = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            planCode: $data['plan_code'],
            description: $data['description'],
            amount: $data['amount'],
            interval: $data['interval'],
            sendInvoices: $data['send_invoices'] ?? null,
            sendSms: $data['send_sms'] ?? null,
            currency: $data['currency'] ?? null,
            currencyCode: $data['currency_code'] ?? null,
            invoiceLimit: $data['invoice_limit'] ?? null,
            metadata: $data['metadata'] ?? null,
            hostedPage: $data['hosted_page'] ?? null,
            hostedPageUrl: $data['hosted_page_url'] ?? null,
            hostedPageSummary: $data['hosted_page_summary'] ?? null,
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
        );
    }
}
