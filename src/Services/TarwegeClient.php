<?php

namespace Tarwege\SmsWhatsapp\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Tarwege\SmsWhatsapp\Exceptions\TarwegeApiException;

class TarwegeClient
{
    protected string $secret;

    protected string $baseUrl;

    protected Client $client;

    public function __construct(string $secret, string $baseUrl = 'https://sms.tarwege.com/api', ?Client $httpClient = null)
    {
        if ($secret === '') {
            throw new TarwegeApiException('API secret is required.', 0);
        }

        $this->secret = $secret;
        $this->baseUrl = rtrim($baseUrl, '/');

        $this->client = $httpClient ?? new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Accept' => 'application/json',
            ],
            'timeout' => 30.0,
            'http_errors' => false,
        ]);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     *
     * @throws TarwegeApiException
     */
    public function get(string $endpoint, array $params = [], bool $attachSecret = true): array
    {
        return $this->request('GET', $endpoint, $params, $attachSecret);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     *
     * @throws TarwegeApiException
     */
    public function post(string $endpoint, array $params = []): array
    {
        return $this->request('POST', $endpoint, $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     *
     * @throws TarwegeApiException
     */
    public function request(string $method, string $endpoint, array $params = [], bool $attachSecret = true): array
    {
        $endpoint = '/' . ltrim($endpoint, '/');
        if ($attachSecret) {
            $params = $this->withSecret($params);
        }

        try {
            $options = [];
            if (strtoupper($method) === 'GET') {
                $options['query'] = $params;
            } else {
                $options['form_params'] = $params;
            }

            $response = $this->client->request($method, $endpoint, $options);
        } catch (GuzzleException $e) {
            throw new TarwegeApiException($e->getMessage(), (int) $e->getCode(), $e);
        }

        $httpCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);

        if (! is_array($data)) {
            throw new TarwegeApiException(
                'Invalid JSON response from API.',
                $httpCode,
                null,
                null,
                is_string($body) ? $body : null
            );
        }

        $apiStatus = (int) ($data['status'] ?? $httpCode);
        if ($apiStatus >= 200 && $apiStatus < 300) {
            return $data;
        }

        $message = (string) ($data['message'] ?? 'API request failed.');
        throw new TarwegeApiException($message, $apiStatus, null, $data);
    }

    /**
     * @deprecated Use get() or post()
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function callApi(string $endpoint, string $method = 'GET', array $params = []): array
    {
        return $this->request($method, $endpoint, $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function deleteById(string $endpoint, int|string $id, string $idKey = 'id', array $params = []): array
    {
        $params[$idKey] = $id;

        return $this->get($endpoint, $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    protected function withSecret(array $params): array
    {
        if (! array_key_exists('secret', $params)) {
            $params['secret'] = $this->secret;
        }

        return $params;
    }
}
