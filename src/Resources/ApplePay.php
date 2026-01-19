<?php

namespace Scwar\LaravelPaystack\Resources;

use Scwar\LaravelPaystack\Contracts\HttpClientInterface;

class ApplePay extends BaseResource
{
    public function __construct(HttpClientInterface $client)
    {
        parent::__construct($client, 'apple-pay');
    }

    /**
     * Register a domain.
     *
     * @param array $data
     * @return array
     */
    public function registerDomain(array $data): array
    {
        return $this->client->post('/apple-pay/domain', $data);
    }

    /**
     * List domains.
     *
     * @return array
     */
    public function listDomains(): array
    {
        $response = $this->client->get('/apple-pay/domain');

        return $this->extractData($response) ?? [];
    }

    /**
     * Unregister a domain.
     *
     * @param string $domainName
     * @return array
     */
    public function unregisterDomain(string $domainName): array
    {
        return $this->client->delete("/apple-pay/domain/{$domainName}");
    }
}
