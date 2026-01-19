<?php

namespace Scwar\LaravelPaystack\DTOs\Responses\Transaction;

readonly class InitializeTransactionData
{
    public function __construct(
        public string $authorizationUrl,
        public string $accessCode,
        public string $reference,
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
            authorizationUrl: $data['authorization_url'],
            accessCode: $data['access_code'],
            reference: $data['reference'],
        );
    }
}
