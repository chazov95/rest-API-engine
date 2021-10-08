<?php

namespace App\Core;


use App\Core\Http\RequestInterface;
use App\Core\Http\Stream;


class Request implements RequestInterface

{

    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getUri()
    {
        return $_SERVER['REQUEST_URI'];
    }
}