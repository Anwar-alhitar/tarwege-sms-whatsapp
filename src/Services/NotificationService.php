<?php

namespace Tarwege\SmsWhatsapp\Services;

class NotificationService
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
    public function deleteNotification(int|string $id, array $params = []): array
    {
        return $this->client->deleteById('/delete/notification', $id, 'id', $params);
    }
}
