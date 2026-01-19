<?php

namespace Scwar\LaravelPaystack\Http\Clients;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\RequestInterface;
use Scwar\LaravelPaystack\Contracts\HttpClientInterface;
use Scwar\LaravelPaystack\Http\ResponseHandler;

class GuzzleClient implements HttpClientInterface
{
    protected Client $client;
    protected string $secretKey;
    protected string $baseUrl;
    protected int $timeout;
    protected int $retryAttempts;
    protected bool $enableLogging;
    protected ResponseHandler $responseHandler;

    public function __construct(
        string $secretKey,
        string $baseUrl = 'https://api.paystack.co',
        int $timeout = 30,
        int $retryAttempts = 3,
        bool $enableLogging = false
    ) {
        $this->secretKey = $secretKey;
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->timeout = $timeout;
        $this->retryAttempts = $retryAttempts;
        $this->enableLogging = $enableLogging;
        $this->responseHandler = new ResponseHandler();

        $stack = HandlerStack::create();
        
        // Add retry middleware
        $stack->push(Middleware::retry(
            function ($retries, Request $request, Response $response = null, $exception = null) {
                if ($retries >= $this->retryAttempts) {
                    return false;
                }

                // Retry on server errors or connection exceptions
                if ($exception instanceof RequestException) {
                    return true;
                }

                if ($response && $response->getStatusCode() >= 500) {
                    return true;
                }

                return false;
            },
            function ($retries) {
                return (int) pow(2, $retries) * 1000; // Exponential backoff
            }
        ));

        // Add logging middleware
        if ($this->enableLogging) {
            $stack->push($this->createLoggingMiddleware());
        }

        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => $this->timeout,
            'handler' => $stack,
            'headers' => [
                'Authorization' => "Bearer {$this->secretKey}",
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
        ]);
    }

    /**
     * Make a GET request.
     */
    public function get(string $endpoint, array $query = []): array
    {
        try {
            $response = $this->client->get($endpoint, [
                'query' => $query,
            ]);

            return $this->responseHandler->handle($response);
        } catch (GuzzleException $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Make a POST request.
     */
    public function post(string $endpoint, array $data = []): array
    {
        try {
            $response = $this->client->post($endpoint, [
                'json' => $data,
            ]);

            return $this->responseHandler->handle($response);
        } catch (GuzzleException $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Make a PUT request.
     */
    public function put(string $endpoint, array $data = []): array
    {
        try {
            $response = $this->client->put($endpoint, [
                'json' => $data,
            ]);

            return $this->responseHandler->handle($response);
        } catch (GuzzleException $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Make a DELETE request.
     */
    public function delete(string $endpoint): array
    {
        try {
            $response = $this->client->delete($endpoint);

            return $this->responseHandler->handle($response);
        } catch (GuzzleException $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Handle Guzzle exceptions.
     *
     * @param GuzzleException $e
     * @return array
     * @throws \Scwar\LaravelPaystack\Exceptions\PaystackException
     */
    protected function handleException(GuzzleException $e): array
    {
        if ($e instanceof RequestException && $e->hasResponse()) {
            return $this->responseHandler->handle($e->getResponse());
        }

        throw new \Scwar\LaravelPaystack\Exceptions\PaystackException(
            $e->getMessage(),
            $e->getCode(),
            $e
        );
    }

    /**
     * Create logging middleware.
     */
    protected function createLoggingMiddleware(): callable
    {
        return function (callable $handler) {
            return function (RequestInterface $request, array $options) use ($handler) {
                $promise = $handler($request, $options);

                return $promise->then(
                    function (Response $response) use ($request) {
                        Log::channel('single')->info('Paystack API Request', [
                            'method' => $request->getMethod(),
                            'uri' => (string) $request->getUri(),
                            'status' => $response->getStatusCode(),
                            'body' => (string) $request->getBody(),
                        ]);

                        return $response;
                    }
                );
            };
        };
    }
}
