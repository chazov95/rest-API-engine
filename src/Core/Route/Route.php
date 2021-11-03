<?php

namespace App\Core\Route;

use App\Core\Container\Autowire\AutowiringClassBuilder;
use App\Core\Container\Autowire\AutowiringMethodBuilder;
use App\Core\Core;
use App\Core\Http\Response;
use App\Core\Transformations\Serializer\Serializer;
use App\Model\Input\Response\AbstractInputResponse;

class Route
{
    /**
     * @var string
     */
    public string $class;

    /**
     * @var string
     */
    public string $method;

    /**
     * @var string[]
     */
    public array $methodArguments;

    /**
     * @var string[]
     */
    public array $classArguments;

    /**
     * для роутов типа /example/1
     *
     * @var array
     */
    public array $uriValues;

    /**
     * Тип роута: api или html
     *
     * @var string
     */
    public string $type;

    /**
     * @throws \App\Core\Container\Autowire\AutowiringException
     * @throws \App\Core\Container\ContainerException
     * @throws \ReflectionException
     * @throws \App\Core\Route\RoutingException
     */
    public function execute(): Response
    {
        $object = AutowiringClassBuilder::getInstance()->setFqn($this->class)->build()->getResult();
        $methodsArguments = AutowiringMethodBuilder::getInstance()
            ->setFqn($this->class)
            ->setMethod($this->method)
            ->build()
            ->getResult();

        return $this->sendResponse(call_user_func_array([$object, $this->method], $methodsArguments));
    }

    /**
     * @param mixed $controllerResponse
     *
     * @return \App\Core\Http\Response
     * @throws \App\Core\Container\ContainerException
     * @throws \App\Core\Route\RoutingException
     */
    private function sendResponse(mixed $controllerResponse): Response
    {
        if ($controllerResponse === false) {
            throw new RoutingException('Can not get response');
        }

        if (!($controllerResponse instanceof AbstractInputResponse)) {
            throw new RoutingException('The answer must be an heir from AbstractInputResponse');
        }

        $container = Core::getSimpleContainer();

        if ($container->has(Serializer::class) === false) {
            throw new RoutingException('Can not get serializer from container. Check container config');
        }

        /** @var Serializer $serializer */
        $serializer = $container->get(Serializer::class);

        $response = new Response();
        $response->setBody($serializer->convertToJson($controllerResponse));
        $response->setResponseCode($controllerResponse->code);

        return $response;
    }
}