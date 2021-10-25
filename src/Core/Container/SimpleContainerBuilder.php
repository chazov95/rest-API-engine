<?php

namespace App\Core\Container;

use App\Core\Container\Autowire\AbstractAutowiring;
use App\Core\Core;
use App\Core\Interfaces\BuilderInterface;

class SimpleContainerBuilder extends AbstractAutowiring implements BuilderInterface
{
    private static ?SimpleContainerBuilder $builder = null;
    private array                          $serviceConfig;

    /**
     * @var \App\Core\Container\Container|null
     */
    private ?Container $container = null;

    /**
     * @return SimpleContainerBuilder
     */
    public static function getInstance(): SimpleContainerBuilder
    {
        if (self::$builder === null) {
            self::$builder = new self();
        }

        return self::$builder;
    }

    /**
     * @throws \ReflectionException
     * @throws \App\Core\Container\ContainerException
     * @throws \App\Core\Container\Autowire\AutowiringException
     */
    public function build(): BuilderInterface
    {
        $this->container = new Container();

        $this->customContainerBind();

        foreach ($this->serviceConfig['classes'] as $fqn) {
            $this->container->add($fqn, $this->createServiceByFqn($fqn, $this->container));
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
     * @param array $loadFqnServicesConfigs
     *
     * @return $this
     */
    public function setServiceConfig(array $loadFqnServicesConfigs): static
    {
        $this->serviceConfig = $loadFqnServicesConfigs;

        return $this;
    }

    private function customContainerBind()
    {
        //TODO implement this method
    }
}