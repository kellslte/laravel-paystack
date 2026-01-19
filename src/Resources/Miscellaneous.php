<?php

namespace Scwar\LaravelPaystack\Resources;

use Scwar\LaravelPaystack\Contracts\HttpClientInterface;

class Miscellaneous extends BaseResource
{
    public function __construct(HttpClientInterface $client)
    {
        parent::__construct($client, 'misc');
    }

    /**
     * Get balance.
     *
     * @return array
     */
    public function balance(): array
    {
        $response = $this->client->get('/balance');

        return $this->extractData($response);
    }

    /**
     * Get balance ledger.
     *
     * @param array $query
     * @return array
     */
    public function balanceLedger(array $query = []): array
    {
        $response = $this->client->get('/balance/ledger', $query);

        return $this->extractData($response);
    }

    /**
     * List banks.
     *
     * @param array $query
     * @return array
     */
    public function banks(array $query = []): array
    {
        $response = $this->client->get('/bank', $query);

        return $this->extractData($response) ?? [];
    }

    /**
     * List countries.
     *
     * @return array
     */
    public function countries(): array
    {
        $response = $this->client->get('/country');

        return $this->extractData($response) ?? [];
    }

    /**
     * List states.
     *
     * @param string $country
     * @return array
     */
    public function states(string $country): array
    {
        $response = $this->client->get("/address_verification/states/{$country}");

        return $this->extractData($response) ?? [];
    }
}
