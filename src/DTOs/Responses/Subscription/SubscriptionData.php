<?php

namespace Scwar\LaravelPaystack\DTOs\Responses\Subscription;

readonly class SubscriptionData
{
    public function __construct(
        public int $id,
        public string $domain,
        public string $status,
        public string $subscriptionCode,
        public string $emailToken,
        public ?string $amount = null,
        public ?string $currency = null,
        public ?string $plan = null,
        public ?object $planObject = null,
        public ?object $customer = null,
        public ?string $authorization = null,
        public ?object $authorizationObject = null,
        public ?bool $invoiceLimit = null,
        public ?string $customerCode = null,
        public ?string $email = null,
        public ?string $nextPaymentDate = null,
        public ?string $openInvoice = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            domain: $data['domain'],
            status: $data['status'],
            subscriptionCode: $data['subscription_code'],
            emailToken: $data['email_token'],
            amount: $data['amount'] ?? null,
            currency: $data['currency'] ?? null,
            plan: $data['plan'] ?? null,
            planObject: isset($data['plan_object']) ? (object) $data['plan_object'] : null,
            customer: isset($data['customer']) ? (object) $data['customer'] : null,
            authorization: $data['authorization'] ?? null,
            authorizationObject: isset($data['authorization_object']) ? (object) $data['authorization_object'] : null,
            invoiceLimit: $data['invoice_limit'] ?? null,
            customerCode: $data['customer_code'] ?? null,
            email: $data['email'] ?? null,
            nextPaymentDate: $data['next_payment_date'] ?? null,
            openInvoice: $data['open_invoice'] ?? null,
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
        );
    }
}
