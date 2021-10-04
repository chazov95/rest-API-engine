<?php

namespace App\Core\Route;

use App\Core\Container\Container;
use App\Core\Data\RouterConfigProvider;
use App\Core\Interfaces\BuilderInterface;
use http\Env\Request;

class RouteBuilder implements BuilderInterface
{
    private static ?RouteBuilder $builder = null;
    private Container $container;
    private Route $route;

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
     * @throws RoutingException
     */
    public function build(): BuilderInterface
    {
        $request = new Request();
        $routeConfig = RouterConfigProvider::getInstance()
            ->findRoute(
                $request->getRequestMethod() ?? '',
                $request->getRequestUrl() ?? ''
            );

        if (count($routeConfig) === 0) {
            throw new RoutingException('Route not found');
        };
        
        $this->route = new Route();

        return $this;
    }

    public function reset(): BuilderInterface
    {
        // TODO: Implement reset() method.
    }

    public function getResult(): Route
    {
        $this->reset();

        return $this->route;
    }

    private function findRouteByUrl(string $url, array $methodRoutes)
    {
        $urlArray = explode('/', $url);

        foreach ($methodRoutes as $configUrl => $route) {
            $configUrlArray = explode('/', $configUrl);
            
            foreach ($configUrlArray as $key => $pathPart) {

            }
        }
    }
}