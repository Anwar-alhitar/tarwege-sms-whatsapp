<?php

namespace Tarwege\SmsWhatsapp\Services;

class SmsService
{
    protected $client;

    public function __construct(TarwegeClient $client)
    {
        $this->client = $client;
    }

    /**
     * Delete a received message.
     */
    public function deleteReceivedMessage(string $messageId)
    {
        return $this->client->callApi("/sms/received/{$messageId}/delete", 'DELETE');
    }

    /**
     * Delete an SMS campaign.
     */
    public function deleteSmsCampaign(string $campaignId)
    {
        return $this->client->callApi("/sms/campaign/{$campaignId}/delete", 'DELETE');
    }

    /**
     * Delete a sent message.
     */
    public function deleteSentMessage(string $messageId)
    {
        return $this->client->callApi("/sms/sent/{$messageId}/delete", 'DELETE');
    }

    /**
     * Get devices.
     */
    public function getDevices(array $params = [])
    {
        return $this->client->callApi('/sms/devices', 'GET', $params);
    }

    /**
     * Get pending messages.
     */
    public function getPendingMessages(array $params = [])
    {
        return $this->client->callApi('/sms/pending', 'GET', $params);
    }

    /**
     * Get received messages.
     */
    public function getReceivedMessages(array $params = [])
    {
        return $this->client->callApi('/sms/received', 'GET', $params);
    }

    /**
     * Get SMS campaigns.
     */
    public function getSmsCampaigns(array $params = [])
    {
        return $this->client->callApi('/sms/campaigns', 'GET', $params);
    }

    /**
     * Get sent messages.
     */
    public function getSentMessages(array $params = [])
    {
        return $this->client->callApi('/sms/sent', 'GET', $params);
    }

    /**
     * Send bulk messages.
     */
    public function sendBulkMessages(array $data)
    {
        return $this->client->callApi('/sms/send/bulk', 'POST', $data);
    }

    /**
     * Send a single message.
     */
    public function sendSingleMessage(array $data)
    {
        return $this->client->callApi('/sms/send/single', 'POST', $data);
    }

    /**
     * Start an SMS campaign.
     */
    public function startSmsCampaign(string $campaignId, array $data = [])
    {
        return $this->client->callApi("/sms/campaign/{$campaignId}/start", 'POST', $data);
    }

    /**
     * Stop an SMS campaign.
     */
    public function stopSmsCampaign(string $campaignId, array $data = [])
    {
        return $this->client->callApi("/sms/campaign/{$campaignId}/stop", 'POST', $data);
    }
}
