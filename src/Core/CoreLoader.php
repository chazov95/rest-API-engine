<?php

namespace App\Core;

use App\Component\Logger\DefaultLogger;
use App\Component\Logger\LogLevels;
use App\Core\Container\Container;
use App\Core\Container\CustomContainerBuilder;
use App\Core\Container\ServiceCreatorBuilder;
use App\Core\Container\SimpleContainerBuilder;
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
        Core::setParameters(ConfigData::loadParameters());
        Core::setServiceCreator(
            ServiceCreatorBuilder::getInstance()->build()->getResult()
        );

        Core::setSimpleContainer(
            SimpleContainerBuilder::getInstance()->build()->getResult()
        );

        try {
            /** @var Container $container */
            Core::setCustomContainer(
                CustomContainerBuilder::getInstance()
                ->setServiceConfig(ConfigData::loadServicesConfigs())
                ->build()
                ->getResult()
            );

            /** @var Route $route */
            $route = RouteBuilder::getInstance()
                ->setRouteConfig(ConfigData::loadRoutes())
                ->build()
                ->getResult();

            $route->execute();
        } catch (Throwable $exception) {
            DefaultLogger::getInstance()->log(
                LogLevels::CRITICAL,
                $exception->getMessage(),
                [
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine()
                ],
                'core'
            );

            /*ErrorResponseFactory::create($exception, $route->type)->send();*/ //TODO реализовать
        }
    }
}