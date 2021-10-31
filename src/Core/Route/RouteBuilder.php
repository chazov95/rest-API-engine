<?php

namespace App\Core\Route;

use App\Core\Container\Container;
use App\Core\Data\RouterConfigProvider;
use App\Core\Interfaces\BuilderInterface;
use App\Core\Request;


class RouteBuilder implements BuilderInterface
{
    private static ?RouteBuilder $builder = null;
    private Container $container;
    private ?Route $route;

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
        $request = Request::getInstance();

        if (in_array($request->getMethod(), ['GET', 'get'])) {
            throw new RoutingException('GET method does not allowed in engine');
        }

        $routeConfig = RouterConfigProvider::getInstance()
            ->findRoute(
                $request->getMethod() ?? '',
                $request->getUri() ?? ''
            );

        $this->route = new Route();
        $this->route->class = $routeConfig['class'];
        $this->route->classArguments = $this->getClassArguments($routeConfig['class']);
        $this->route->method = $routeConfig['method'];
        $this->route->methodArguments = $this->getmethodArguments($routeConfig);
        $this->route->type = 'restApi';
        $this->route->uriValues = $this->getValuesFromUri($routeConfig);

        return $this;
    }

    public function reset(): BuilderInterface
    {
        $this->route = null;

        return $this;
    }

    public function getResult(): Route
    {
        $result = $this->route;
        $this->reset();

        return $result;
    }

    private function getClassArguments(mixed $class): array
    {
        return [];
    }

    private function getmethodArguments(array $routeConfig):array
    {
        return [];
    }

    /**
     * @param array $routeConfig
     *
     * @return array
     */
    private function getValuesFromUri(array $routeConfig): array
    {
        $pathValues = [];

        foreach ($routeConfig["uriTemplate"] as $key => $configPart) {
            if (preg_match('/^[{]{1}.*[}]{1}$/', $configPart, $matches) === 1) {
                $pathValues[substr($configPart, 1, -1)] =  $routeConfig['uri'][$key];
            }
        }

        return $pathValues;
    }
}