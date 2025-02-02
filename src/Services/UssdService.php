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
    public function clearPendingUssd(array $params = [])
    {
        return $this->client->callApi('/ussd/pending/clear', 'POST', $params);
    }

    /**
     * Delete a USSD request.
     */
    public function deleteUssdRequest(string $requestId)
    {
        return $this->client->callApi("/ussd/{$requestId}/delete", 'DELETE');
    }

    /**
     * Get USSD requests.
     */
    public function getUssdRequests(array $params = [])
    {
        return $this->client->callApi('/ussd/requests', 'GET', $params);
    }

    /**
     * Send a USSD request.
     */
    public function sendUssdRequest(array $data)
    {
        return $this->client->callApi('/ussd/send', 'POST', $data);
    }
}
