<?php

namespace Scwar\LaravelPaystack\DTOs\Responses\Transaction;

readonly class LogData
{
    public function __construct(
        public ?int $timeSpent = null,
        public ?int $attempts = null,
        public ?string $authentication = null,
        public ?int $errors = null,
        public ?bool $success = null,
        public ?bool $mobile = null,
        public ?array $input = null,
        public ?string $channel = null,
        public ?array $history = null,
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
            timeSpent: $data['time_spent'] ?? null,
            attempts: $data['attempts'] ?? null,
            authentication: $data['authentication'] ?? null,
            errors: $data['errors'] ?? null,
            success: $data['success'] ?? null,
            mobile: $data['mobile'] ?? null,
            input: $data['input'] ?? null,
            channel: $data['channel'] ?? null,
            history: $data['history'] ?? null,
        );
    }
}
