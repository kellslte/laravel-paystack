<?php

namespace Scwar\LaravelPaystack\Resources;

use Scwar\LaravelPaystack\Contracts\HttpClientInterface;

class Charge extends BaseResource
{
    public function __construct(HttpClientInterface $client)
    {
        parent::__construct($client, 'charge');
    }

    /**
     * Create a charge.
     *
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        $response = $this->client->post('/charge', $data);

        return $this->extractData($response);
    }

    /**
     * Submit PIN.
     *
     * @param array $data
     * @return array
     */
    public function submitPin(array $data): array
    {
        $response = $this->client->post('/charge/submit_pin', $data);

        return $this->extractData($response);
    }

    /**
     * Submit OTP.
     *
     * @param array $data
     * @return array
     */
    public function submitOtp(array $data): array
    {
        $response = $this->client->post('/charge/submit_otp', $data);

        return $this->extractData($response);
    }

    /**
     * Submit phone number.
     *
     * @param array $data
     * @return array
     */
    public function submitPhone(array $data): array
    {
        $response = $this->client->post('/charge/submit_phone', $data);

        return $this->extractData($response);
    }

    /**
     * Submit birthday.
     *
     * @param array $data
     * @return array
     */
    public function submitBirthday(array $data): array
    {
        $response = $this->client->post('/charge/submit_birthday', $data);

        return $this->extractData($response);
    }

    /**
     * Submit address.
     *
     * @param array $data
     * @return array
     */
    public function submitAddress(array $data): array
    {
        $response = $this->client->post('/charge/submit_address', $data);

        return $this->extractData($response);
    }

    /**
     * Check pending charge.
     *
     * @param string $reference
     * @return array
     */
    public function checkPending(string $reference): array
    {
        $response = $this->client->get("/charge/{$reference}");

        return $this->extractData($response);
    }
}
