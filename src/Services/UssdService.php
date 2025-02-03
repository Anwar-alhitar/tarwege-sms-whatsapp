<?php

namespace Tarwege\SmsWhatsapp\Services;

class UssdService
{
    protected $client;

    public function __construct(TarwegeClient $client)
    {
        $this->client = $client;
    }

    /**
     * Clear pending USSD.
     */
    public function clearPendingUssd(array $params = []): mixed
    {
        return $this->client->callApi('/ussd/pending/clear', 'POST', $params);
    }

    /**
     * Delete a USSD request.
     */
    public function deleteUssdRequest(string $requestId): mixed
    {
        return $this->client->callApi("/ussd/{$requestId}/delete", 'DELETE');
    }

    /**
     * Get USSD requests.
     */
    public function getUssdRequests(array $params = []): mixed
    {
        return $this->client->callApi('/ussd/requests', 'GET', $params);
    }

    /**
     * Send a USSD request.
     */
    public function sendUssdRequest(array $data): mixed
    {
        return $this->client->callApi('/ussd/send', 'POST', $data);
    }
}
