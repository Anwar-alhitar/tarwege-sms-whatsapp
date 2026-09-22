<?php

namespace Tarwege\SmsWhatsapp\Services;

class ContactService
{
    protected TarwegeClient $client;

    public function __construct(TarwegeClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createContact(array $data): array
    {
        return $this->client->post('/create/contact', $data);
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createGroup(array $data): array
    {
        return $this->client->post('/create/group', $data);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function deleteContact(int|string $id, array $params = []): array
    {
        return $this->client->deleteById('/delete/contact', $id, 'id', $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function deleteGroup(int|string $id, array $params = []): array
    {
        return $this->client->deleteById('/delete/group', $id, 'id', $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function deleteUnsubscribed(array $params = []): array
    {
        return $this->client->get('/delete/unsubscribed', $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getContacts(array $params = []): array
    {
        return $this->client->get('/get/contacts', $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getGroups(array $params = []): array
    {
        return $this->client->get('/get/groups', $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getUnsubscribed(array $params = []): array
    {
        return $this->client->get('/get/unsubscribed', $params);
    }
}
