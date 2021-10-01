<?php

namespace App\Core\Container;


use App\Core\Core;
use App\Core\Exception\ContainerBuilderException;
use App\Core\Interfaces\BuilderInterface;
use ReflectionClass;
use ReflectionParameter;


class CustomContainerBuilder implements BuilderInterface
{
    public const TAG = "tag";

    /** @var \App\Core\Interfaces\BuilderInterface|null */
    private static ?BuilderInterface $builder = null;

    /**
     * @var array
     */
    private array $serviceConfig;

    /** @var \App\Core\Container\Container|null */
    private ?Container $container;

    private function __construct()
    {
    }

    /**
     * @return \App\Core\Container\CustomContainerBuilder
     */
    public static function getInstance(): CustomContainerBuilder
    {
        if (self::$builder === null) {
            self::$builder = new self();
        }

        return self::$builder;
    }

    /**
     * @param array $serviceConfig
     *
     * @return \App\Core\Container\CustomContainerBuilder
     */
    public function setServiceConfig(array $serviceConfig): CustomContainerBuilder
    {
        $this->serviceConfig = $serviceConfig;

        return $this;
    }

    /**
     * @throws \ReflectionException|\App\Core\Exception\ContainerBuilderException
     */
    public function build(): BuilderInterface
    {
        $this->container = new Container();

        foreach ($this->serviceConfig['classes'] as $tag => $class) {
            $this->container->add($tag, $this->createServiceByTag((string)$tag));
        }

        return $this;
    }

    public function reset(): BuilderInterface
    {
        $this->serviceConfig = [];
        $this->container = null;

        return $this;
    }

    public function getResult(): Container
    {
        $this->reset();

        return $this->container;
    }

    /**
     * @param string $tag
     *
     * @return void
     * @throws \App\Core\Exception\ContainerBuilderException
     * @throws \ReflectionException
     */
    private function createServiceByTag(string $tag = ''): mixed
    {
        if (!empty($tag) && $this->container->has($tag)) {
            return;
        }

        $className = $this->serviceConfig[$tag]['class'];

        $reflection = new ReflectionClass($className);
        $constructor = $reflection->getConstructor();

        if ($constructor === null) {
            throw new ContainerBuilderException(
                sprintf('constructor for %s dose not accessible', $className)
            );
        }

        $parameters = $constructor->getParameters();

        if (count($parameters) === 0) {
            if (count($this->serviceConfig[$tag]['arguments']) > 0) {
                throw new ContainerBuilderException(sprintf('config for %s is wrong', $className));
            }

            return new $this->serviceConfig[$tag]['class']();
        }

        $constructorArguments = [];

        foreach ($parameters as $key => $parameter) {
            $type = $parameter->getType();

            if ($this->serviceConfig[$tag]['arguments'][$key]['type'] === 'tag') {
                $constructorArguments[]
                    = $this->createServiceByTag($this->serviceConfig[$tag]['arguments'][$key]['value']);

                continue;
            }

            if ($this->serviceConfig[$tag]['arguments'][$key]['type'] === 'object') {
                $constructorArguments[]
                    = $this->createServiceByFqn($this->serviceConfig[$tag]['arguments'][$key]['value']);

                continue;
            }

            $constructorArguments[] = $this->castToSimpleType($this->serviceConfig[$tag]['arguments'][$key]);
        }
    }

    /**
     * @param array $argument
     *
     * @return array|float|bool|int|string
     * @throws \App\Core\Exception\ContainerBuilderException
     */
    private function castToSimpleType(array $argument): array|float|bool|int|string
    {
        return match ($argument['type']) {
            'string' => $argument['value'],
            'bool', 'boolean' => (boolean)$argument['value'],
            'float' => (float)$argument['value'],
            'int', 'integer' => (int)$argument['value'],
            'array' => explode(',', $argument['value']),
            default => throw new ContainerBuilderException("Can't cast value"),
        };
    }

    /**
     * @throws \ReflectionException
     * @throws ContainerBuilderException
     */
    private function createServiceByFqn(string $className)
    {
        $simpleContainer = Core::getSimpleContainew();

        if ($simpleContainer->has($className)) {
            return $simpleContainer->get($className);
        };

        $reflection = new ReflectionClass($className);
        $constructor = $reflection->getConstructor();

        if ($constructor === null) {
            throw new ContainerBuilderException(
                sprintf('constructor for %s dose not accessible', $className)
            );
        }

        $parameters = $constructor->getParameters();

        if (count($parameters) === 0) {
            $simpleContainer->add($className, new $className());

            return $simpleContainer->get($className);
        }

        foreach ($parameters as $key => $parameter) {
            $type = $parameter->getType();

            if ($type->isBuiltin()) {
                    $constructorArguments[] = $parameter->getDefaultValue();
            } else {
                $this->createServiceByFqn($parameter->getType());
            }
        }
    }
}