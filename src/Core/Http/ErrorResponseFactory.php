<?php

namespace App\Core\Http;

use App\Core\Interfaces\FactoryInterface;
use http\Env\Response;
use http\Message;
use http\Message\Body;
use Throwable;

class ErrorResponseFactory implements FactoryInterface
{
    private static ErrorResponseFactory $factory;
    private Throwable $exception;

    private function __construct(Throwable $exception)
    {
        $this->exception = $exception;
    }

    /**
     * @param Throwable $exception
     * @return ErrorResponseFactory
     */
    public static function getInstance(Throwable $exception): ErrorResponseFactory
    {
        if (self::$factory === null) {
            self::$factory = new self($exception);
        }

        return self::$factory;
    }

    public function create(): ErrorResponse
    {
        $response = new ErrorResponse();
        $body = new Body();

        $body->addForm(Serializer::toArray($this->exception));
        $response->setHeaders()
            ->setHttpVersion()
            ->setResponseCode()
            ->setResponseStatus()
            ->setBody($body);

        return $response;

        // TODO: Implement create() method.
    }
}