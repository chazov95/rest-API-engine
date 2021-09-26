<?php

namespace App\Core\Route;

use App\Component\Factory\FactoryInterface;
use App\Core\Container\Container;
use Component\Builder\BuilderInterface;

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
    public static function get(): RouteBuilder
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

    /**
     *
     * @param \App\Core\Container\Container $container
     *
     * @return \App\Core\Route\RouteBuilder
     */
    public function setContainer(Container $container): RouteBuilder
    {
        $this->container = $container;

        return $this;
    }

    public function build(): BuilderInterface
    {
        // TODO: Implement build() method.
    }

    public function reset(): BuilderInterface
    {
        // TODO: Implement reset() method.
    }

    public function getResult()
    {
        // TODO: Implement getResult() method.
    }
}