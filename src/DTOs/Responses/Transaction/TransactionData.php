<?php

namespace Scwar\LaravelPaystack\DTOs\Responses\Transaction;

readonly class TransactionData
{
    public function __construct(
        public int $id,
        public string $domain,
        public string $status,
        public string $reference,
        public int $amount,
        public ?string $message = null,
        public ?string $gatewayResponse = null,
        public ?string $paidAt = null,
        public ?string $createdAt = null,
        public ?string $channel = null,
        public ?string $currency = null,
        public ?string $ipAddress = null,
        public ?string $metadata = null,
        public ?LogData $log = null,
        public ?int $fees = null,
        public ?object $feesSplit = null,
        public ?AuthorizationData $authorization = null,
        public ?CustomerData $customer = null,
        public ?PlanData $plan = null,
        public ?SplitData $split = null,
        public ?string $orderId = null,
        public ?string $paidAtFormatted = null,
        public ?string $createdAtFormatted = null,
        public ?int $requestedAmount = null,
        public ?object $posTransactionData = null,
        public ?string $source = null,
        public ?array $feesBreakdown = null,
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
            domain: $data['domain'],
            status: $data['status'],
            reference: $data['reference'],
            amount: $data['amount'],
            message: $data['message'] ?? null,
            gatewayResponse: $data['gateway_response'] ?? null,
            paidAt: $data['paid_at'] ?? null,
            createdAt: $data['created_at'] ?? null,
            channel: $data['channel'] ?? null,
            currency: $data['currency'] ?? null,
            ipAddress: $data['ip_address'] ?? null,
            metadata: $data['metadata'] ?? null,
            log: isset($data['log']) ? LogData::fromArray($data['log']) : null,
            fees: $data['fees'] ?? null,
            feesSplit: isset($data['fees_split']) ? (object) $data['fees_split'] : null,
            authorization: isset($data['authorization']) ? AuthorizationData::fromArray($data['authorization']) : null,
            customer: isset($data['customer']) ? CustomerData::fromArray($data['customer']) : null,
            plan: isset($data['plan']) ? PlanData::fromArray($data['plan']) : null,
            split: isset($data['split']) ? SplitData::fromArray($data['split']) : null,
            orderId: $data['order_id'] ?? null,
            paidAtFormatted: $data['paid_at_formatted'] ?? null,
            createdAtFormatted: $data['created_at_formatted'] ?? null,
            requestedAmount: $data['requested_amount'] ?? null,
            posTransactionData: isset($data['pos_transaction_data']) ? (object) $data['pos_transaction_data'] : null,
            source: $data['source'] ?? null,
            feesBreakdown: $data['fees_breakdown'] ?? null,
        );
    }
}
