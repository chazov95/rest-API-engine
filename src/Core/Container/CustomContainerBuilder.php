<?php

namespace App\Core\Container;


use App\Core\Container\Autowire\AbstractAutowiring;
use App\Core\Core;
use App\Core\Container\ContainerBuilderException;
use App\Core\Data\ConfigDataException;
use App\Core\Interfaces\BuilderInterface;
use ReflectionClass;
use ReflectionParameter;


class CustomContainerBuilder extends AbstractAutowiring implements BuilderInterface
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
     * @throws \ReflectionException|\App\Core\Container\ContainerBuilderException
     * @throws ConfigDataException
     */
    public function build(): BuilderInterface
    {
        $this->container = new Container();
        $this->customContainerBind();
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
        return $this->container;
    }

    /**
     * @param string $tag
     *
     * @return object
     * @throws \App\Core\Container\ContainerBuilderException
     * @throws \ReflectionException
     */
    private function createServiceByTag(string $tag = ''): object
    {
        if (!empty($tag) && $this->container->has($tag)) {
            return $this->container->get($tag);
        }

        $className = $this->serviceConfig['classes'][$tag]['class'];
        $reflection = new ReflectionClass($className);
        $constructor = $reflection->getConstructor();

        if ($constructor === null) {
            throw new ContainerBuilderException(
                sprintf('constructor for %s dose not accessible', $className)
            );
        }

        $parameters = $constructor->getParameters();

        if (count($parameters) === 0) {
            if (count($this->serviceConfig['classes'][$tag]['arguments']) > 0) {
                throw new ContainerBuilderException(sprintf('Config for %s is wrong', $className));
            }

            return new $this->serviceConfig['classes'][$tag]['class']();
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

        return $reflection->newInstanceArgs($constructorArguments);
    }

    /**
     * @throws ConfigDataException
     */
    private function customContainerBind()
    {
        $customBind = [];

        require_once __DIR__ . "/../../../config/prebinding/CustomContainerBind.php";

        if (is_array($customBind)) {
            foreach ($customBind as $tag => $recipe) {
                if ($this->container->has($tag)) {
                    continue;
                }

                if (!is_callable($recipe)) {
                    throw new ConfigDataException('Recipe for customContainer not callable.');
                }

                $object = $recipe();

                if (!is_object($object)) {
                    throw new ConfigDataException(strpos("Recipe for %s returned not object", $tag));
                }

                $this->container->add($tag, $object);
            }
        }
    }
}