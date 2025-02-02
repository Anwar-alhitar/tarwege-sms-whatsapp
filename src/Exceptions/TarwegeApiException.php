<?php

namespace Tarwege\SmsWhatsapp\Exceptions;

use Exception;

class TarwegeApiException extends Exception
{
    public function __construct($message, $code = 0, \Throwable $previous = null)
    {
        parent::__construct("API Error: {$message} (Code: {$code})", $code, $previous);
    }
}