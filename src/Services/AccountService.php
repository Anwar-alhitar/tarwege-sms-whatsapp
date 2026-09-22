<?php

namespace Tarwege\SmsWhatsapp\Services;

class AccountService
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
    public function getEarnings(array $params = []): array
    {
        return $this->client->get('/get/earnings', $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getCredits(array $params = []): array
    {
        return $this->client->get('/get/credits', $params);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getSubscription(array $params = []): array
    {
        return $this->client->get('/get/subscription', $params);
    }

    /** @deprecated Use getEarnings() */
    public function getPartnerEarnings(array $params = []): array
    {
        return $this->getEarnings($params);
    }

    /** @deprecated Use getCredits() */
    public function getRemainingCredits(array $params = []): array
    {
        return $this->getCredits($params);
    }

    /** @deprecated Use getSubscription() */
    public function getSubscriptionPackage(array $params = []): array
    {
        return $this->getSubscription($params);
    }
}
