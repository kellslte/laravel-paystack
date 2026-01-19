<?php

namespace Scwar\LaravelPaystack\Resources;

use Scwar\LaravelPaystack\Contracts\HttpClientInterface;
use Scwar\LaravelPaystack\DTOs\Requests\Customer\CreateCustomerRequest;
use Scwar\LaravelPaystack\DTOs\Requests\Customer\UpdateCustomerRequest;
use Scwar\LaravelPaystack\DTOs\Responses\Customer\CustomerData;
use Scwar\LaravelPaystack\Support\Pagination;

class Customer extends BaseResource
{
    public function __construct(HttpClientInterface $client)
    {
        parent::__construct($client, 'customer');
    }

    /**
     * Create a customer.
     *
     * @param CreateCustomerRequest|array $request
     * @return CustomerData
     */
    public function create(CreateCustomerRequest|array $request): CustomerData
    {
        if (is_array($request)) {
            $request = CreateCustomerRequest::fromArray($request);
        }

        $response = $this->client->post('/customer', $request->toArray());

        return CustomerData::fromArray($this->extractData($response));
    }

    /**
     * List customers.
     *
     * @param array $query
     * @return array{data: array, pagination: Pagination|null}
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('/customer', $query);

        return [
            'data' => array_map(
                fn($item) => CustomerData::fromArray($item),
                $this->extractData($response) ?? []
            ),
            'pagination' => $this->getPagination($response),
        ];
    }

    /**
     * Fetch a customer.
     *
     * @param string $idOrCode
     * @return CustomerData
     */
    public function fetch(string $idOrCode): CustomerData
    {
        $response = $this->client->get("/customer/{$idOrCode}");

        return CustomerData::fromArray($this->extractData($response));
    }

    /**
     * Update a customer.
     *
     * @param string $idOrCode
     * @param UpdateCustomerRequest|array $request
     * @return CustomerData
     */
    public function update(string $idOrCode, UpdateCustomerRequest|array $request): CustomerData
    {
        if (is_array($request)) {
            $request = UpdateCustomerRequest::fromArray($request);
        }

        $response = $this->client->put("/customer/{$idOrCode}", $request->toArray());

        return CustomerData::fromArray($this->extractData($response));
    }

    /**
     * Whitelist or blacklist a customer.
     *
     * @param string $customerCode
     * @param string $riskAction
     * @return CustomerData
     */
    public function setRiskAction(string $customerCode, string $riskAction): CustomerData
    {
        $response = $this->client->post("/customer/set_risk_action", [
            'customer' => $customerCode,
            'risk_action' => $riskAction,
        ]);

        return CustomerData::fromArray($this->extractData($response));
    }

    /**
     * Deactivate an authorization.
     *
     * @param string $authorizationCode
     * @return array
     */
    public function deactivateAuthorization(string $authorizationCode): array
    {
        return $this->client->post('/customer/deactivate_authorization', [
            'authorization_code' => $authorizationCode,
        ]);
    }

    /**
     * Validate customer identification.
     *
     * @param string $customerCode
     * @param array $data
     * @return CustomerData
     */
    public function validateIdentification(string $customerCode, array $data): CustomerData
    {
        $response = $this->client->post("/customer/{$customerCode}/identification", $data);

        return CustomerData::fromArray($this->extractData($response));
    }

    /**
     * Initialize customer authorization.
     *
     * @param string $customerCode
     * @param array $data
     * @return array
     */
    public function initializeAuthorization(string $customerCode, array $data): array
    {
        $response = $this->client->post("/customer/{$customerCode}/authorization/initialize", $data);

        return $this->extractData($response);
    }

    /**
     * Verify customer authorization.
     *
     * @param string $reference
     * @return array
     */
    public function verifyAuthorization(string $reference): array
    {
        $response = $this->client->get("/customer/authorization/verify/{$reference}");

        return $this->extractData($response);
    }
}
