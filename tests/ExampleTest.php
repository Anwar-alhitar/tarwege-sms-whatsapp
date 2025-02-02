<?php

namespace Tarwege\SmsWhatsapp\Tests;

use PHPUnit\Framework\TestCase;
use Tarwege\SmsWhatsapp\Services\TarwegeClient;

class ExampleTest extends TestCase
{
    public function testClientInstantiation()
    {
        $client = new TarwegeClient('dummy-key');
        $response = $client->callApi('/test', 'GET');
        
        $this->assertIsArray($response);
        $this->assertArrayHasKey('endpoint', $response);
    }
}
