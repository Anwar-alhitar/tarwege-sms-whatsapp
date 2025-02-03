<?php

namespace Tarwege\SmsWhatsapp\Services;

class SystemService
{
    protected $client;

    public function __construct(TarwegeClient $client)
    {
        $this->client = $client;
    }

    /**
     * Get gateway rates.
     */
    public function getGatewayRates(array $params = []): mixed
    {
        return $this->client->callApi('/system/gateway-rates', 'GET', $params);
    }

    /**
     * Get shorteners.
     */
    public function getShorteners(array $params = []): mixed
    {
        return $this->client->callApi('/system/shorteners', 'GET', $params);
    }
}
