<?php

namespace App\Core\Container;

use App\Core\Interfaces\Psr\ContainerInterface;

class Container implements ContainerInterface
{
    /**
     * @var object[]
     */
    private static array $simpleContainer;
    private static array $customContainer;

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
    public function addSimpleService(string $className, object $instance): void
    {
        self::$simpleContainer[$className] = $instance;
    }

    /**
     * @param string $tag
     * @param object $instance
     */
    public function addCustomService(string $tag, object $instance): void
    {
        self::$customContainer[$tag] = $instance;
    }
}