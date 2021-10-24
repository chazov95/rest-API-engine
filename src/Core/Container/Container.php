<?php

namespace App\Core\Container;

use App\Core\Interfaces\ExtendedContainerInterface;
use App\Core\Interfaces\Psr\ContainerInterface;

class Container extends AbstractContainer implements ExtendedContainerInterface
{
    /** @var array */
    protected array $data = [];

    /**
     * @throws \App\Core\Container\ContainerException
     */
    public function get($id): object
    {
        if (!isset($this->data[$id])) {
            throw new ContainerException(sprintf('Service %s dont exist', $id));
        }

        return $this->data[$id];
    }

    /**
     * @param string $key
     * @param object $object
     */
    public function add(string $key, object $object): void
    {
        $this->data[$key] = $object;
    }

    /**
     * @param string $key
     * @param callable $function
     */
    public function bind(string $key, callable $function): void
    {
        $this->data[$key] = $function();
    }
}