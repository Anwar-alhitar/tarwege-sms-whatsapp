<?php

namespace Tarwege\SmsWhatsapp\Facades;

use Illuminate\Support\Facades\Facade;

class Tarwege extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Tarwege\SmsWhatsapp\Services\TarwegeClient::class;
    }
}
