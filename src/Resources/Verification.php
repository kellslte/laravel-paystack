<?php

namespace Scwar\LaravelPaystack\Resources;

use Scwar\LaravelPaystack\Contracts\HttpClientInterface;

class Verification extends BaseResource
{
    public function __construct(HttpClientInterface $client)
    {
        parent::__construct($client, 'verification');
    }

    /**
     * Resolve account number.
     *
     * @param array $data
     * @return array
     */
    public function resolveAccountNumber(array $data): array
    {
        $response = $this->client->get('/bank/resolve', $data);

        return $this->extractData($response);
    }

    /**
     * Resolve BVN.
     *
     * @param string $bvn
     * @return array
     */
    public function resolveBvn(string $bvn): array
    {
        $response = $this->client->get("/bank/resolve_bvn/{$bvn}");

        return $this->extractData($response);
    }

    /**
     * Resolve card BIN.
     *
     * @param string $bin
     * @return array
     */
    public function resolveCardBin(string $bin): array
    {
        $response = $this->client->get("/decision/bin/{$bin}");

        return $this->extractData($response);
    }

    /**
     * Validate account.
     *
     * @param array $data
     * @return array
     */
    public function validateAccount(array $data): array
    {
        $response = $this->client->post('/bank/validate', $data);

        return $this->extractData($response);
    }
}
