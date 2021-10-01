<?php

namespace App\Core\Container;

use App\Core\Interfaces\Psr\ContainerInterface;

abstract class AbstractContainer implements ContainerInterface
{
    public function has($id): bool
    {
        return isset($this->data[$id]);
    }
}