<?php

namespace Tarwege\SmsWhatsapp\Services;

class SystemService
{
    protected TarwegeClient $client;

    public function __construct(TarwegeClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getGatewayRates(array $params = []): array
    {
        return $this->client->get('/get/rates', $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getShorteners(array $params = []): array
    {
        return $this->client->get('/get/shorteners', $params);
    }
}
