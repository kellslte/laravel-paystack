<?php

namespace Scwar\LaravelPaystack\DTOs\Responses\Transaction;

readonly class AuthorizationData
{
    public function __construct(
        public ?string $authorizationCode = null,
        public ?string $bin = null,
        public ?string $last4 = null,
        public ?string $expMonth = null,
        public ?string $expYear = null,
        public ?string $channel = null,
        public ?string $cardType = null,
        public ?string $bank = null,
        public ?string $countryCode = null,
        public ?string $brand = null,
        public ?bool $reusable = null,
        public ?string $signature = null,
        public ?string $accountName = null,
        public ?string $receiverBank = null,
        public ?string $receiverBankAccountNumber = null,
        public ?string $receiverName = null,
        public ?string $senderBank = null,
        public ?string $senderBankAccountNumber = null,
        public ?string $senderName = null,
        public ?string $senderCountry = null,
        public ?string $receiverCountry = null,
        public ?string $receiptNumber = null,
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
            authorizationCode: $data['authorization_code'] ?? null,
            bin: $data['bin'] ?? null,
            last4: $data['last4'] ?? null,
            expMonth: $data['exp_month'] ?? null,
            expYear: $data['exp_year'] ?? null,
            channel: $data['channel'] ?? null,
            cardType: $data['card_type'] ?? null,
            bank: $data['bank'] ?? null,
            countryCode: $data['country_code'] ?? null,
            brand: $data['brand'] ?? null,
            reusable: $data['reusable'] ?? null,
            signature: $data['signature'] ?? null,
            accountName: $data['account_name'] ?? null,
            receiverBank: $data['receiver_bank'] ?? null,
            receiverBankAccountNumber: $data['receiver_bank_account_number'] ?? null,
            receiverName: $data['receiver_name'] ?? null,
            senderBank: $data['sender_bank'] ?? null,
            senderBankAccountNumber: $data['sender_bank_account_number'] ?? null,
            senderName: $data['sender_name'] ?? null,
            senderCountry: $data['sender_country'] ?? null,
            receiverCountry: $data['receiver_country'] ?? null,
            receiptNumber: $data['receipt_number'] ?? null,
        );
    }
}
