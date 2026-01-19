<?php

namespace Scwar\LaravelPaystack\Support;

class WebhookSignature
{
    /**
     * Verify webhook signature.
     *
     * @param string $payload
     * @param string $signature
     * @param string $secret
     * @return bool
     */
    public static function verify(string $payload, string $signature, string $secret): bool
    {
        if (empty($signature) || empty($secret)) {
            return false;
        }

        $computedSignature = hash_hmac('sha512', $payload, $secret);

        return hash_equals($computedSignature, $signature);
    }

    /**
     * Verify webhook signature from request.
     *
     * @param string $payload
     * @param string|null $signatureHeader
     * @param string $secret
     * @return bool
     */
    public static function verifyFromRequest(string $payload, ?string $signatureHeader, string $secret): bool
    {
        if (!$signatureHeader) {
            return false;
        }

        return self::verify($payload, $signatureHeader, $secret);
    }
}
