<?php

namespace App\Core;

use App\Component\Logger\DefaultLogger;
use App\Component\Logger\LogLevels;
use App\Core\Container\Container;
use App\Core\Container\ContainerBuilder;
use App\Core\Data\ConfigData;
use App\Core\Route\Route;
use App\Core\Route\RouteBuilder;
use Throwable;

class CoreLoader
{
    /**
     * @throws \App\Core\Data\ConfigDataException
     */
    public function load(): void
    {
        ConfigData::loadParameters();

        try {
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
        } catch (Throwable $exception) {
            $logger = DefaultLogger::get('core');

            $logger->log(
                    LogLevels::CRITICAL,
                    $exception->getMessage(),
                    [
                        'file' => $exception->getFile(),
                        'line' => $exception->getLine()
                    ]
                );

            /*ErrorResponseFactory::create($exception, $route->type)->send();*/ //TODO реализовать
        }
    }
}