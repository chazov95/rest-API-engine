<?php

namespace App\Core\Container\Autowire;

use App\Core\Container\Container;
use App\Core\Container\ContainerBuilderException;
use App\Core\Core;
use ReflectionClass;

abstract class AbstractAutowiring
{
    /**
     * @param array $argument
     *
     * @return array|float|bool|int|string
     * @throws \App\Core\Container\Autowire\AutowiringException
     */
    protected function castToSimpleType(array $argument): array|float|bool|int|string
    {
        return match ($argument['type']) {
            'string' => $argument['value'],
            'bool', 'boolean' => (boolean) $argument['value'],
            'float' => (float) $argument['value'],
            'int', 'integer' => (int) $argument['value'],
            'array' => explode(',', $argument['value']),
            default => throw new AutowiringException("Can't cast value"),
        };
    }

    /**
     * @param string                             $className
     * @param \App\Core\Container\Container|null $container
     *
     * @return mixed|object
     * @throws \App\Core\Container\ContainerException
     * @throws \ReflectionException
     */
    protected function createServiceByFqn(string $className, Container $container = null)
    {
        $simpleContainer = $container ?? Core::getSimpleContainer();

        if ($simpleContainer->has($className)) {
            return $simpleContainer->get($className);
        }

        $reflection = new ReflectionClass($className);
        $constructor = $reflection->getConstructor();

        if ($constructor === null) {
            return $this->addAndGetService($simpleContainer, $className);
        }

        $parameters = $constructor->getParameters();

        if (count($parameters) === 0) {
            return $this->addAndGetService($simpleContainer, $className);
        }

        $constructorArguments = [];

        foreach ($parameters as $key => $parameter) {
            $type = $parameter->getType();

            if ($type->isBuiltin()) {
                $constructorArguments[] = $parameter->getDefaultValue();
            } else {
                $constructorArguments[] = $this->createServiceByFqn($parameter->getType());
            }
        }

        return $reflection->newInstanceArgs($constructorArguments);
    }

    /**
     * @param        $simpleContainer
     * @param string $className
     *
     * @return mixed
     */
    private function addAndGetService($simpleContainer, string $className): mixed
    {
        $simpleContainer->add($className, new $className());

        return $simpleContainer->get($className);
    }
}