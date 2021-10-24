<?php

namespace App\Core\Container\Autowire;

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
     * @throws \ReflectionException
     * @throws \App\Core\Container\Autowire\AutowiringException
     * @throws \App\Core\Container\ContainerException
     */
    protected function createServiceByFqn(string $className)
    {
        $simpleContainer = Core::getSimpleContainer();

        if ($simpleContainer->has($className)) {
            return $simpleContainer->get($className);
        }

        $reflection = new ReflectionClass($className);
        $constructor = $reflection->getConstructor();

        if ($constructor === null) {
            throw new AutowiringException(
                sprintf('constructor for %s dose not accessible', $className)
            );
        }

        $parameters = $constructor->getParameters();

        if (count($parameters) === 0) {
            $simpleContainer->add($className, new $className());

            return $simpleContainer->get($className);
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
}