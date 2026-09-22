<?php

namespace Tarwege\SmsWhatsapp\Services;

class UssdService
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
    public function deleteUssdRequest(int|string $id, array $params = []): array
    {
        return $this->client->deleteById('/delete/ussd', $id, 'id', $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getUssdRequests(array $params = []): array
    {
        return $this->client->get('/get/ussd', $params);
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function sendUssdRequest(array $data): array
    {
        return $this->client->post('/send/ussd', $data);
    }
}
