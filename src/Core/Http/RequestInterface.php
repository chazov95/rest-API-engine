<?php

namespace App\Core\Http;


interface RequestInterface
{

    public function getMethod(): string;

    public function getUri();

}