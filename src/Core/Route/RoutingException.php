<?php

namespace App\Core\Route;

class RoutingException extends \Exception
{

    /**
     * @param string $string
     */
    public function __construct(string $string)
    {
    }
}