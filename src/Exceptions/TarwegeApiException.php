<?php

namespace Tarwege\SmsWhatsapp\Exceptions;

use Exception;
use Throwable;

class TarwegeApiException extends Exception
{
    /** @var array<string, mixed>|null */
    protected ?array $response;

    /** @var mixed */
    protected $rawBody;

    /**
     * @param  array<string, mixed>|null  $response
     */
    public function __construct(
        string $message,
        int $code = 0,
        ?Throwable $previous = null,
        ?array $response = null,
        $rawBody = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->response = $response;
        $this->rawBody = $rawBody;
    }

    /**
     * @return array<string, mixed>|null
     */
    public function getResponse(): ?array
    {
        return $this->response;
    }

    /**
     * @return mixed
     */
    public function getRawBody()
    {
        return $this->rawBody;
    }
}
