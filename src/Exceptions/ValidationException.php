<?php

namespace Scwar\LaravelPaystack\Exceptions;

class ValidationException extends PaystackException
{
    protected array $errors = [];

    public function __construct(string $message = '', int $code = 0, ?\Exception $previous = null, ?array $response = null, array $errors = [])
    {
        parent::__construct($message, $code, $previous, $response);
        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
