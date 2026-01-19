<?php

namespace Scwar\LaravelPaystack\Contracts;

interface HttpClientInterface
{
    /**
     * Make a GET request.
     *
     * @param string $endpoint
     * @param array $query
     * @return array
     */
    public function get(string $endpoint, array $query = []): array;

    /**
     * Make a POST request.
     *
     * @param string $endpoint
     * @param array $data
     * @return array
     */
    public function post(string $endpoint, array $data = []): array;

    /**
     * Make a PUT request.
     *
     * @param string $endpoint
     * @param array $data
     * @return array
     */
    public function put(string $endpoint, array $data = []): array;

    /**
     * Make a DELETE request.
     *
     * @param string $endpoint
     * @return array
     */
    public function delete(string $endpoint): array;
}
