<?php

namespace App\Core\Abstractions;

use App\Core\Interfaces\ControllerInterface;

abstract class AbstractController implements ControllerInterface
{
    public function __construct()
    {
    }
}