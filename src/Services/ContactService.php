<?php

namespace Tarwege\SmsWhatsapp\Services;

class ContactService
{
    protected $client;

    public function __construct(TarwegeClient $client)
    {
        $this->client = $client;
    }

    /**
     * Create a new contact.
     */
    public function createContact(array $data)
    {
        return $this->client->callApi('/contacts/create', 'POST', $data);
    }

    /**
     * Create a new group.
     */
    public function createGroup(array $data)
    {
        return $this->client->callApi('/contacts/group/create', 'POST', $data);
    }

    /**
     * Delete a contact.
     */
    public function deleteContact(string $contactId)
    {
        return $this->client->callApi("/contacts/{$contactId}/delete", 'DELETE');
    }

    /**
     * Delete a group.
     */
    public function deleteGroup(string $groupId)
    {
        return $this->client->callApi("/contacts/group/{$groupId}/delete", 'DELETE');
    }

    /**
     * Delete unsubscribed contacts.
     */
    public function deleteUnsubscribed(array $params = [])
    {
        return $this->client->callApi('/contacts/unsubscribed/delete', 'DELETE', $params);
    }

    /**
     * Get contacts.
     */
    public function getContacts(array $params = [])
    {
        return $this->client->callApi('/contacts', 'GET', $params);
    }

    /**
     * Get groups.
     */
    public function getGroups(array $params = [])
    {
        return $this->client->callApi('/contacts/groups', 'GET', $params);
    }

    /**
     * Get unsubscribed contacts.
     */
    public function getUnsubscribed(array $params = [])
    {
        return $this->client->callApi('/contacts/unsubscribed', 'GET', $params);
    }
}
