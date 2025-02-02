<?php

namespace Tarwege\SmsWhatsapp\Services;

class OTPService
{
    protected $client;

    public function __construct(TarwegeClient $client)
    {
        $this->client = $client;
    }

    /**
     * Send an OTP.
     */
    public function sendOTP(array $data)
    {
        return $this->client->callApi('/otp/send', 'POST', $data);
    }

    /**
     * Verify an OTP.
     */
    public function verifyOTP(array $data)
    {
        return $this->client->callApi('/otp/verify', 'POST', $data);
    }
}
