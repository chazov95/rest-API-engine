<?php

namespace App\Core;

use App\Core\Container\Container;
use App\Core\Container\ContainerBuilder;
use App\Core\Data\ConfigData;
use App\Core\Route\Route;
use App\Core\Route\RouteBuilder;

class CoreLoader
{
    /**
     * @throws \App\Core\Data\ConfigDataException
     */
    public function load(): void
    {
        ConfigData::loadParameters();

        /** @var Container $container */
        $container = ContainerBuilder::get()
            ->setServiceConfig(ConfigData::loadServicesConfigs())
            ->build()
            ->getResult();

        /** @var Route $route */
        $route = RouteBuilder::get()
            ->setRouteConfig(ConfigData::loadRoutes())
            ->setContainer($container)
            ->build()
            ->getResult();

        $route->execute();
    }
}