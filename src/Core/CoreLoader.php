<?php

namespace App\Core;

use App\Component\Logger\DefaultLogger;
use App\Component\Logger\LogLevels;
use App\Core\Container\Container;
use App\Core\Container\CustomContainerBuilder;
use App\Core\Container\ServiceCreatorBuilder;
use App\Core\Container\SimpleContainerBuilder;
use App\Core\Data\ConfigData;
use App\Core\Data\ConfigDataException;
use App\Core\Http\ErrorResponseFactory;
use App\Core\Route\Route;
use App\Core\Route\RouteBuilder;
use http\Exception;
use Throwable;

class CoreLoader
{
    public function load(): void
    {
        try {
            Core::setParameters(ConfigData::loadParameters());
            /*Core::setServiceCreator(
                ServiceCreatorBuilder::getInstance()->build()->getResult()
            );*/

            Core::setSimpleContainer(
                SimpleContainerBuilder::getInstance()->build()->getResult()
            );

            /** @var Container $container */
            Core::setCustomContainer(
                CustomContainerBuilder::getInstance()
                    ->setServiceConfig(ConfigData::loadServicesConfigs())
                    ->build()
                    ->getResult()
            );

            /** @var Route $route */
            $route = RouteBuilder::getInstance()
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
            echo $exception->getMessage()."</br>";
            echo $exception->getFile()."</br>";
            echo $exception->getLine()."</br>";
            /*$this->sendResponse(ErrorResponseFactory::getInstance($exception)->create());  //TODO реализовать*/
        }
    }

    private function sendResponse(Http\ErrorResponse $response)
    {
        echo $response->serialize();
    }
}