<?php

namespace App\Core\Exception;

use JetBrains\PhpStorm\Pure;
use Throwable;

class ExtendedException extends \Exception
{
    private string $responseCode;
    private string $logLevel;

    #[Pure] public function __construct(
        $message = "",
        $code = 0,
        string $responseCode = '',
        string $logLevel = '',
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);

        $this->responseCode = $responseCode;
        $this->logLevel = $logLevel;
    }

    /**
     * @return string
     */
    public function getResponseCode(): string
    {
        return $this->responseCode;
    }

    /**
     * @return string
     */
    public function getLogLevel(): string
    {
        return $this->logLevel;
    }
}