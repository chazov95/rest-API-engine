<?php

namespace App\Core\Container;


use App\Core\Exception\ContainerBuilderException;
use App\Core\Interfaces\BuilderInterface;
use ReflectionClass;


class ContainerBuilder implements BuilderInterface
{
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
     * @return \App\Core\Container\ContainerBuilder
     */
    public static function getInstance(): ContainerBuilder
    {
        if (self::$builder === null) {
            self::$builder =  new self();
        }

        return self::$builder;
    }

    /**
     * @param array $serviceConfig
     *
     * @return \App\Core\Container\ContainerBuilder
     */
    public function setServiceConfig(array $serviceConfig): ContainerBuilder
    {
        $this->serviceConfig = $serviceConfig;

        return $this;
    }

    public function build(): BuilderInterface
    {
        $container = new Container();

        foreach ($this->serviceConfig['classes'] as $key => $class) {
            $this->createService((string) $key, $class, $container);
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
     * @param string                        $key
     * @param mixed                         $class
     * @param \App\Core\Container\Container $container
     *
     * @return void
     * @throws \ReflectionException
     */
    private function createService(string $key, mixed $class, Container $container): void
    {
        if ($container->has($key)) {
           return;
        }

        $reflection = new ReflectionClass($class['class']);

        $atributes = [];

        if (isset($class['attributes']) && is_array($class['attributes'])) {
            foreach ($class['attributes'] as $tag) {
                $atributes[] = $this->createServicesByTag($tag);
            }
        } elseif (count($reflection->getAttributes()) > 0) {
            foreach ($reflection->getAttributes() as $attribute) {
                $atributes[] =
            }
        }

        $container->add($key, $object);
    }
}