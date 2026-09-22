<?php

namespace Tarwege\SmsWhatsapp\Services;

class OTPService
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
    public function sendOTP(array $data): array
    {
        return $this->client->post('/send/otp', $data);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function verifyOTP(string $otp, array $params = []): array
    {
        $params['otp'] = $otp;

        return $this->client->get('/get/otp', $params);
    }
}
