<?php

namespace Tarwege\SmsWhatsapp\Services;

class SmsService
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
    public function deleteReceivedMessage(int|string $id, array $params = []): array
    {
        return $this->client->deleteById('/delete/sms.received', $id, 'id', $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function deleteSmsCampaign(int|string $id, array $params = []): array
    {
        return $this->client->deleteById('/delete/sms.campaign', $id, 'id', $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function deleteSentMessage(int|string $id, array $params = []): array
    {
        return $this->client->deleteById('/delete/sms.sent', $id, 'id', $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getDevices(array $params = []): array
    {
        return $this->client->get('/get/devices', $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getPendingMessages(array $params = []): array
    {
        return $this->client->get('/get/sms.pending', $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getReceivedMessages(array $params = []): array
    {
        return $this->client->get('/get/sms.received', $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getSmsCampaigns(array $params = []): array
    {
        return $this->client->get('/get/sms.campaigns', $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getSmsMessage(array $params = []): array
    {
        return $this->client->get('/get/sms.message', $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getSentMessages(array $params = []): array
    {
        return $this->client->get('/get/sms.sent', $params);
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function sendSms(array $data): array
    {
        return $this->client->post('/send/sms', $data);
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function sendSmsBulk(array $data): array
    {
        return $this->client->post('/send/sms.bulk', $data);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function startSmsCampaign(int|string $campaignId, array $params = []): array
    {
        $params['campaign'] = $campaignId;

        return $this->client->get('/remote/start.sms', $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function stopSmsCampaign(int|string $campaignId, array $params = []): array
    {
        $params['campaign'] = $campaignId;

        return $this->client->get('/remote/stop.sms', $params);
    }

    /** @deprecated Use sendSms() */
    public function sendSingleMessage(array $data): array
    {
        return $this->sendSms($data);
    }

    /** @deprecated Use sendSmsBulk() */
    public function sendBulkMessages(array $data): array
    {
        return $this->sendSmsBulk($data);
    }
}
