<?php

namespace App\Core\Http;

use App\Core\Interfaces\FactoryInterface;
use http\Env\Response;
use http\Message;
use http\Message\Body;
use JsonException;
use Throwable;

class ErrorResponseFactory implements FactoryInterface
{
    private static ?ErrorResponseFactory $factory = null;
    private Throwable                    $exception;

    /**
     * @param \Throwable $exception
     */
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

        try {
            $body = json_encode([
                'success' => false,
                'message' => $this->exception->getMessage(),
            ], JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            $body = sprintf('{"succes": false, "message": %s}', $exception->getMessage());
        }


        $response->setResponseCode($this->exception->getCode() ?? 400)
            ->setBody($body);

        return $response;
    }
}