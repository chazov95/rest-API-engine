<?php

namespace App\Core\Container;

use App\Core\Interfaces\ExtendedContainerInterface;
use App\Core\Interfaces\Psr\ContainerInterface;

class Container extends AbstractContainer implements ExtendedContainerInterface
{
    /** @var array */
    protected array $data = [];

    public function get($id)
    {
        // TODO: Implement get() method.
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