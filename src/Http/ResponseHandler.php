<?php

namespace Scwar\LaravelPaystack\Http;

use Scwar\LaravelPaystack\Exceptions\AuthenticationException;
use Scwar\LaravelPaystack\Exceptions\NotFoundException;
use Scwar\LaravelPaystack\Exceptions\PaystackException;
use Scwar\LaravelPaystack\Exceptions\RateLimitException;
use Scwar\LaravelPaystack\Exceptions\ServerException;
use Scwar\LaravelPaystack\Exceptions\ValidationException;
use Psr\Http\Message\ResponseInterface;

class ResponseHandler
{
    /**
     * Handle the HTTP response and convert to array.
     *
     * @param ResponseInterface $response
     * @return array
     * @throws PaystackException
     */
    public function handle(ResponseInterface $response): array
    {
        $statusCode = $response->getStatusCode();
        $body = (string) $response->getBody();
        $data = json_decode($body, true);

        // Handle non-2xx status codes
        if ($statusCode < 200 || $statusCode >= 300) {
            $this->handleError($statusCode, $data ?? []);
        }

        // Check if Paystack API returned an error status
        if (isset($data['status']) && $data['status'] === false) {
            $message = $data['message'] ?? 'An error occurred';
            $errors = $data['errors'] ?? [];

            if ($statusCode === 401) {
                throw new AuthenticationException($message, $statusCode, null, $data);
            }

            if ($statusCode === 404) {
                throw new NotFoundException($message, $statusCode, null, $data);
            }

            if ($statusCode === 422) {
                throw new ValidationException($message, $statusCode, null, $data, $errors);
            }

            if ($statusCode === 429) {
                throw new RateLimitException($message, $statusCode, null, $data);
            }

            if ($statusCode >= 500) {
                throw new ServerException($message, $statusCode, null, $data);
            }

            throw new PaystackException($message, $statusCode, null, $data);
        }

        return $data ?? [];
    }

    /**
     * Handle HTTP errors.
     *
     * @param int $statusCode
     * @param array $data
     * @return void
     * @throws PaystackException
     */
    protected function handleError(int $statusCode, array $data): void
    {
        $message = $data['message'] ?? "HTTP Error {$statusCode}";
        $errors = $data['errors'] ?? [];

        match ($statusCode) {
            401 => throw new AuthenticationException($message, $statusCode, null, $data),
            404 => throw new NotFoundException($message, $statusCode, null, $data),
            422 => throw new ValidationException($message, $statusCode, null, $data, $errors),
            429 => throw new RateLimitException($message, $statusCode, null, $data),
            default => throw $statusCode >= 500
                ? new ServerException($message, $statusCode, null, $data)
                : new PaystackException($message, $statusCode, null, $data),
        };
    }
}
