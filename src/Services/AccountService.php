<?php

namespace Tarwege\SmsWhatsapp\Services;

class AccountService
{
    protected $client;

    public function __construct(TarwegeClient $client)
    {
        $this->client = $client;
    }

    /**
     * Get Partner Earnings.
     */
    public function getPartnerEarnings(array $params = [])
    {
        return $this->client->callApi('/account/partner-earnings', 'GET', $params);
    }

    /**
     * Get Remaining Credits.
     */
    public function getRemainingCredits(array $params = [])
    {
        return $this->client->callApi('/account/remaining-credits', 'GET', $params);
    }

    /**
     * Get Subscription Package.
     */
    public function getSubscriptionPackage(array $params = [])
    {
        return $this->client->callApi('/account/subscription-package', 'GET', $params);
    }
}
