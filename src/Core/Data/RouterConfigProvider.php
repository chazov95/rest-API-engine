<?php

namespace App\Core\Data;

use App\Component\Logger\LogLevels;
use App\Core\Route\RoutingException;
use JsonException;

class RouterConfigProvider
{
    private static ?RouterConfigProvider $manager = null;

    private array $routeConfig;

    /**
     * @throws ConfigDataException
     */
    public function __construct()
    {
        try {
            $this->routeConfig = json_decode(
                file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/../config/routes.json'),
                true,
                512,
                JSON_THROW_ON_ERROR
            );
        } catch (JsonException $exception) {
            throw new ConfigDataException($exception->getMessage());
        }
    }

    /**
     * @return RouterConfigProvider
     */
    public static function getInstance(): RouterConfigProvider
    {
        if (self::$manager === null) {
            self::$manager = new self();
        }

        return self::$manager;
    }

    public function getRoutesByMethod(string $method)
    {
        if (!isset($this->routeConfig[$method])) {
            return null;
        };

        return $this->routeConfig[$method];
    }

    /**
     * @param string $method
     * @param string $url
     *
     * @return array
     * @throws \App\Core\Route\RoutingException
     */
    public function findRoute(string $method, string $url): array
    {
        $explodeUrl = explode('/', $url);
        $lastElement = array_pop($explodeUrl);

        if (!empty($lastElement) && count($explodeUrl) > 0) {
            $explodeUrl[] = $lastElement;
        }

        if (!isset($this->routeConfig[$method])) {
            throw new RoutingException('Route not found', 404, 'NOT_FOUND', LogLevels::INFO);
        }

        foreach ($this->routeConfig[$method] as $path => $routeConfig) {
            $configPathArray = explode( '/', $path);

            if (count($configPathArray) !== count($explodeUrl)) {
                continue;
            }

            if ($this->comparePathes($explodeUrl, $configPathArray)) {
                $this->routeConfig[$method][$path]['uri'] = $explodeUrl;
                $this->routeConfig[$method][$path]['uriTemplate'] = $configPathArray;

                return $this->routeConfig[$method][$path];
            }
        }

        throw new RoutingException('Route not found', 404, 'NOT_FOUND', LogLevels::INFO);
    }

    /**
     * @param array $requestUrl
     * @param array $configUrl
     *
     * @return bool
     */
    private function comparePathes(array $requestUrl, array $configUrl): bool
    {
        foreach ($requestUrl as $index => $pathPart) {
            if ($pathPart !== $configUrl[$index] && preg_match('/^[{]{1}.*[}]{1}$/', $configUrl[$index]) !== 1) {
                return false;
            }
        }

        return true;
    }
}