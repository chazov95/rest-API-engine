<?php

namespace App\Core\Abstractions;

use App\Core\Interfaces\ControllerInterface;
use App\Core\Interfaces\Psr\LoggerInterface;
use http\Env\Request;

abstract class AbstractController implements ControllerInterface
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}