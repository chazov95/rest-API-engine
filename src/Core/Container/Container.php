<?php

namespace App\Core\Container;

use App\Core\Interfaces\Psr\ContainerInterface;

class Container implements ContainerInterface
{
    /**
     * @var object[]
     */
    private static array $container;

    public function __construct()
    {
    }

    public function get($id)
    {
        // TODO: Implement get() method.
    }

    public function has($id)
    {
        // TODO: Implement has() method.
    }

    /**
     * @param string $className
     * @param object $instance
     */
    public function add(string $className, object $instance): void
    {
        self::$container[$className] = $instance;
    }
}