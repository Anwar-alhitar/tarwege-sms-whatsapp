<?php

namespace Tarwege\SmsWhatsapp\Services;

class WhatsAppService
{
    protected $client;

    public function __construct(TarwegeClient $client)
    {
        $this->client = $client;
    }

    /**
     * Delete a received chat.
     */
    public function deleteReceivedChat(string $chatId)
    {
        return $this->client->callApi("/whatsapp/chats/received/{$chatId}/delete", 'DELETE');
    }

    /**
     * Delete a sent chat.
     */
    public function deleteSentChat(string $chatId)
    {
        return $this->client->callApi("/whatsapp/chats/sent/{$chatId}/delete", 'DELETE');
    }

    /**
     * Delete a WhatsApp account.
     */
    public function deleteWhatsAppAccount(string $accountId)
    {
        return $this->client->callApi("/whatsapp/account/{$accountId}/delete", 'DELETE');
    }

    /**
     * Delete a WhatsApp campaign.
     */
    public function deleteWhatsAppCampaign(string $campaignId)
    {
        return $this->client->callApi("/whatsapp/campaign/{$campaignId}/delete", 'DELETE');
    }

    /**
     * Get WhatsApp accounts.
     */
    public function getAccounts(array $params = [])
    {
        return $this->client->callApi('/whatsapp/accounts', 'GET', $params);
    }

    /**
     * Get pending chats.
     */
    public function getPendingChats(array $params = [])
    {
        return $this->client->callApi('/whatsapp/chats/pending', 'GET', $params);
    }

    /**
     * Get received chats.
     */
    public function getReceivedChats(array $params = [])
    {
        return $this->client->callApi('/whatsapp/chats/received', 'GET', $params);
    }

    /**
     * Get sent chats.
     */
    public function getSentChats(array $params = [])
    {
        return $this->client->callApi('/whatsapp/chats/sent', 'GET', $params);
    }

    /**
     * Get WhatsApp campaigns.
     */
    public function getWhatsAppCampaigns(array $params = [])
    {
        return $this->client->callApi('/whatsapp/campaigns', 'GET', $params);
    }

    /**
     * Get WhatsApp group contacts.
     */
    public function getWhatsAppGroupContacts(string $groupId, array $params = [])
    {
        return $this->client->callApi("/whatsapp/groups/{$groupId}/contacts", 'GET', $params);
    }

    /**
     * Get WhatsApp groups.
     */
    public function getWhatsAppGroups(array $params = [])
    {
        return $this->client->callApi('/whatsapp/groups', 'GET', $params);
    }

    /**
     * Get WhatsApp QR image.
     */
    public function getWhatsAppQrImage(string $accountId)
    {
        return $this->client->callApi("/whatsapp/account/{$accountId}/qr", 'GET');
    }

    /**
     * Get WhatsApp servers.
     */
    public function getWhatsAppServers(array $params = [])
    {
        return $this->client->callApi('/whatsapp/servers', 'GET', $params);
    }

    /**
     * Get WhatsApp information after linking.
     */
    public function getWhatsAppInformationAfterLinking(string $accountId)
    {
        return $this->client->callApi("/whatsapp/account/{$accountId}/info", 'GET');
    }

    /**
     * Link a WhatsApp account.
     */
    public function linkWhatsAppAccount(array $data)
    {
        return $this->client->callApi('/whatsapp/account/link', 'POST', $data);
    }

    /**
     * Relink a WhatsApp account.
     */
    public function relinkWhatsAppAccount(array $data)
    {
        return $this->client->callApi('/whatsapp/account/relink', 'POST', $data);
    }

    /**
     * Send bulk chats.
     */
    public function sendBulkChats(array $data)
    {
        return $this->client->callApi('/whatsapp/chats/send/bulk', 'POST', $data);
    }

    /**
     * Send a single chat.
     */
    public function sendSingleChat(array $data)
    {
        return $this->client->callApi('/whatsapp/chats/send/single', 'POST', $data);
    }

    /**
     * Start a WhatsApp campaign.
     */
    public function startWhatsAppCampaign(string $campaignId, array $data = [])
    {
        return $this->client->callApi("/whatsapp/campaign/{$campaignId}/start", 'POST', $data);
    }

    /**
     * Stop a WhatsApp campaign.
     */
    public function stopWhatsAppCampaign(string $campaignId, array $data = [])
    {
        return $this->client->callApi("/whatsapp/campaign/{$campaignId}/stop", 'POST', $data);
    }

    /**
     * Validate a WhatsApp phone number.
     */
    public function validateWhatsAppPhoneNumber(array $data)
    {
        return $this->client->callApi('/whatsapp/phone/validate', 'POST', $data);
    }
}
