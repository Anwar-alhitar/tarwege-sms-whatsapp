<?php

namespace Tarwege\SmsWhatsapp\Services;

class NotificationService
{
    protected $client;

    public function __construct(TarwegeClient $client)
    {
        $this->client = $client;
    }

    /**
     * Delete a notification.
     */
    public function deleteNotification(string $notificationId): mixed
    {
        return $this->client->callApi("/notifications/{$notificationId}/delete", 'DELETE');
    }

    /**
     * Get notifications.
     */
    public function getNotifications(array $params = []): mixed
    {
        return $this->client->callApi('/notifications', 'GET', $params);
    }
}
