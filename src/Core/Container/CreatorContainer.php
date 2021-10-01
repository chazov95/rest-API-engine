<?php

namespace App\Core\Container;

use App\Core\Interfaces\CreatorContainerInterface;
use App\Core\Interfaces\Psr\ContainerExceptionInterface;
use App\Core\Interfaces\Psr\ContainerInterface;
use App\Core\Interfaces\Psr\NotFoundExceptionInterface;

class CreatorContainer extends AbstractContainer implements CreatorContainerInterface
{
    /** @var array */
    protected array $data = [];

    /**
     * @param string $id
     * @return object|null
     */
    public function get($id): ?object
    {
        if (isset($data[$id]) && is_callable($data[$id])) {
            return $data[$id]();
        }

        return null;
    }

    /**
     * @param string $key
     * @param callable $function
     */
    public function bindCreator(string $key, callable $function): void
    {
        $this->data[$key] = $function;
    }
}