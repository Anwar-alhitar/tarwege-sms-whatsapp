<?php

namespace Tarwege\SmsWhatsapp\Services;

class WhatsAppService
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
    public function deleteReceivedChat(int|string $id, array $params = []): array
    {
        return $this->client->deleteById('/delete/wa.received', $id, 'id', $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function deleteSentChat(int|string $id, array $params = []): array
    {
        return $this->client->deleteById('/delete/wa.sent', $id, 'id', $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function deleteWhatsAppAccount(int|string $id, array $params = []): array
    {
        return $this->client->deleteById('/delete/wa.account', $id, 'id', $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function deleteWhatsAppCampaign(int|string $id, array $params = []): array
    {
        return $this->client->deleteById('/delete/wa.campaign', $id, 'id', $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getAccounts(array $params = []): array
    {
        return $this->client->get('/get/wa.accounts', $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getPendingChats(array $params = []): array
    {
        return $this->client->get('/get/wa.pending', $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getReceivedChats(array $params = []): array
    {
        return $this->client->get('/get/wa.received', $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getSentChats(array $params = []): array
    {
        return $this->client->get('/get/wa.sent', $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getWhatsAppCampaigns(array $params = []): array
    {
        return $this->client->get('/get/wa.campaigns', $params);
    }

    /**
     * @param  array<string, mixed>  $params  Must include unique and gid unless passed as arguments
     * @return array<string, mixed>
     */
    public function getWhatsAppGroupContacts(string $unique, string $gid, array $params = []): array
    {
        $params['unique'] = $unique;
        $params['gid'] = $gid;

        return $this->client->get('/get/wa.group.contacts', $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getWhatsAppGroups(array $params = []): array
    {
        return $this->client->get('/get/wa.groups', $params);
    }

    /**
     * @return array<string, mixed>
     */
    public function getWhatsAppQrImage(string $token): array
    {
        return $this->client->get('/get/wa.qr', ['token' => $token], false);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getWhatsAppServers(array $params = []): array
    {
        return $this->client->get('/get/wa.servers', $params);
    }

    /**
     * @return array<string, mixed>
     */
    public function getWhatsAppInformationAfterLinking(string $token): array
    {
        return $this->client->get('/get/wa.info', ['token' => $token], false);
    }

    /**
     * @param  array<string, mixed>  $params  Optional sid (server id)
     * @return array<string, mixed>
     */
    public function linkWhatsAppAccount(array $params = []): array
    {
        return $this->client->get('/create/wa.link', $params);
    }

    /**
     * @param  array<string, mixed>  $params  Must include unique (account id)
     * @return array<string, mixed>
     */
    public function relinkWhatsAppAccount(array $params): array
    {
        return $this->client->get('/create/wa.relink', $params);
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function sendWhatsApp(array $data): array
    {
        return $this->client->post('/send/whatsapp', $data);
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function sendWhatsAppBulk(array $data): array
    {
        return $this->client->post('/send/whatsapp.bulk', $data);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function startWhatsAppCampaign(int|string $campaignId, array $params = []): array
    {
        $params['campaign'] = $campaignId;

        return $this->client->get('/remote/start.chats', $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function stopWhatsAppCampaign(int|string $campaignId, array $params = []): array
    {
        $params['campaign'] = $campaignId;

        return $this->client->get('/remote/stop.chats', $params);
    }

    /** @deprecated Use sendWhatsApp() */
    public function sendSingleChat(array $data): array
    {
        return $this->sendWhatsApp($data);
    }

    /** @deprecated Use sendWhatsAppBulk() */
    public function sendBulkChats(array $data): array
    {
        return $this->sendWhatsAppBulk($data);
    }
}
