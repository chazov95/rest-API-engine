<?php

namespace App\Core\Data;

use App\Core\Route\RoutingException;
use JsonException;

class RouterConfigProvider
{
    private static RouterConfigProvider $manager;

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
     */
    public function findRoute(string $method, string $url): array
    {

    }
}