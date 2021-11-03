<?php

namespace App\Core\Http;

class Response
{
    private array  $headers = [];
    private string $body;
    private int    $responseCode;

    /**
     * @param string $body
     *
     * @return Response
     */
    public function setBody(string $body): Response
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param int $responseCode
     *
     * @return Response
     */
    public function setResponseCode(int $responseCode): Response
    {
        $this->responseCode = $responseCode;

        return $this;
    }

    /**
     * @return int
     */
    public function getResponseCode(): int
    {
        return $this->responseCode;
    }
}