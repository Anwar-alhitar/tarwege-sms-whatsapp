<?php

namespace Tarwege\SmsWhatsapp\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Tarwege\SmsWhatsapp\Exceptions\TarwegeApiException;

class TarwegeClient
{
    protected $apiKey;
    protected $baseUrl;
    protected $client;

    /**
     * Constructor.
     *
     * @param string $apiKey
     * @param string $baseUrl
     */
    public function __construct(string $apiKey, string $baseUrl = 'https://api.tarwege.com')
    {
        $this->apiKey  = $apiKey;
        $this->baseUrl = rtrim($baseUrl, '/');

        // Initialize the Guzzle client with default settings.
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers'  => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept'        => 'application/json',
            ],
            'timeout'  => 10.0, // seconds
        ]);
    }

    /**
     * Generic method to make API calls.
     *
     * @param string $endpoint The API endpoint (relative to the base URL).
     * @param string $method   HTTP method (GET, POST, PUT, DELETE, etc.).
     * @param array  $params   Request parameters.
     *
     * @return mixed
     *
     * @throws TarwegeApiException
     */
    public function callApi(string $endpoint, string $method = 'GET', array $params = []): mixed
    {
        try {
            // Prepare options depending on the request method.
            $options = [];
            if (strtoupper($method) === 'GET') {
                $options['query'] = $params;
            } else {
                // For non-GET requests, send the data as JSON.
                $options['json'] = $params;
            }

            // Make the HTTP request.
            $response = $this->client->request($method, $endpoint, $options);

            // Get response status and body.
            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();

            // Decode the JSON response.
            $data = json_decode($body, true);

            // Check if the response status indicates success.
            if ($statusCode >= 200 && $statusCode < 300) {
                return $data;
            }

            // If status code is not in the success range, throw an exception.
            throw new TarwegeApiException("API error: HTTP $statusCode", $statusCode);
        } catch (RequestException $e) {
            // You can log the error details here if needed.
            $message = $e->getResponse()
                ? $e->getResponse()->getBody()->getContents()
                : $e->getMessage();

            throw new TarwegeApiException("Request failed: " . $message, $e->getCode(), $e);
        }
    }
}
