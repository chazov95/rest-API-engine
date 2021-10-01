<?php

namespace App\Core\Route;

use App\Core\Container\Container;
use App\Core\Interfaces\BuilderInterface;

class RouteBuilder implements BuilderInterface
{
    private static RouteBuilder $builder;
    private array $config;
    private Container $container;

    private function __construct()
    {
    }

    /**
     * @return \App\Core\Route\RouteBuilder
     */
    public static function getInstance(): RouteBuilder
    {
        if (self::$builder === null) {
            self::$builder = new self();
        }

        return self::$builder;
    }

    /**
     * @param array $routeConfig
     *
     * @return \App\Core\Route\RouteBuilder
     */
    public function setRouteConfig(array $routeConfig): RouteBuilder
    {
        $this->config = $routeConfig;

        return $this;
    }

    public function build(): BuilderInterface
    {

    }

    public function reset(): BuilderInterface
    {
        // TODO: Implement reset() method.
    }

    public function getResult(): mixed
    {
        $this->reset();
        // TODO: Implement getResult() method.
    }
}