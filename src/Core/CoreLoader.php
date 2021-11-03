<?php

namespace App\Core;

use App\Component\Logger\DefaultLogger;
use App\Component\Logger\LogLevels;
use App\Core\Container\Container;
use App\Core\Container\CustomContainerBuilder;
use App\Core\Container\SimpleContainerBuilder;
use App\Core\Data\ConfigData;
use App\Core\Exception\ExchangeException;
use App\Core\Http\ErrorResponseFactory;
use App\Core\Http\Response;
use App\Core\Route\Route;
use App\Core\Route\RouteBuilder;
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
                SimpleContainerBuilder::getInstance()
                    ->setServiceConfig(ConfigData::loadFqnServicesConfigs())
                    ->build()
                    ->getResult()
            );

            /** @var Container $container */
            Core::setCustomContainer(
                CustomContainerBuilder::getInstance()
                    ->setServiceConfig(ConfigData::loadTagServicesConfigs())
                    ->build()
                    ->getResult()
            );

            /** @var Route $route */
            $route = RouteBuilder::getInstance()
                ->build()
                ->getResult();

            $this->sendJsonResponse($route->execute());
        } catch (Throwable $exception) {
            if ($exception instanceof ExchangeException) {
                $level = $exception->getLogLevel();
            } else {
                $level = LogLevels::CRITICAL;
            }

            DefaultLogger::getInstance()->log(
                $level,
                $exception->getMessage(),
                [
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine(),
                ],
                'core'
            );

            $this->sendJsonResponse(ErrorResponseFactory::getInstance($exception)->create());
        }
    }

    /**
     * @param \App\Core\Http\Response $response
     */
    private function sendJsonResponse(Response $response): void
    {
        header('Content-Type: application/json');
        http_response_code($response->getResponseCode());

        foreach ($response->getHeaders() as $header) {
            header($header);
        }

        echo $response->getBody();
    }
}