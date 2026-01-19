<?php

namespace Scwar\LaravelPaystack\Exceptions;

use Exception;

class PaystackException extends Exception
{
    protected ?array $response = null;

    public function __construct(string $message = '', int $code = 0, ?Exception $previous = null, ?array $response = null)
    {
        parent::__construct($message, $code, $previous);
        $this->response = $response;
    }

    public function getResponse(): ?array
    {
        return $this->response;
    }
}
