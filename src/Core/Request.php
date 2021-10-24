<?php

namespace App\Core;


use App\Core\Http\RequestInterface;


class Request implements RequestInterface
{

    /**
     * @var \App\Core\Request|null
     */
    private static ?Request $request = null;

    private function __construct()
    {
    }

    /**
     * @return \App\Core\Request
     */
    public static function getInstance(): Request
    {
        if (self::$request === null) {
            self::$request = new self();
        }

        return self::$request;
    }


    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getUri()
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function getQuery(string $paramName): string
    {
        //TODO need implement
        return 'not implemented';
    }
}