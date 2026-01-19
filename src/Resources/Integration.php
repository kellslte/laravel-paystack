<?php

namespace Scwar\LaravelPaystack\Resources;

use Scwar\LaravelPaystack\Contracts\HttpClientInterface;

class Integration extends BaseResource
{
    public function __construct(HttpClientInterface $client)
    {
        parent::__construct($client, 'integration');
    }

    /**
     * Get payment session timeout.
     *
     * @return array
     */
    public function getPaymentSessionTimeout(): array
    {
        $response = $this->client->get('/integration/payment_session_timeout');

        return $this->extractData($response);
    }

    /**
     * Update payment session timeout.
     *
     * @param int $timeout
     * @return array
     */
    public function updatePaymentSessionTimeout(int $timeout): array
    {
        $response = $this->client->put('/integration/payment_session_timeout', [
            'timeout' => $timeout,
        ]);

        return $this->extractData($response);
    }
}
