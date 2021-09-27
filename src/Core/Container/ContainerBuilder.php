<?php

namespace App\Core\Container;


use App\Core\Interfaces\BuilderInterface;

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
    public static function get(): ContainerBuilder
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
//TODO
        /*foreach ($this->serviceConfig['classes'] as $key => $class) {
            $container->add()
        }

        echo '<pre>';
        print_r($this->serviceConfig);
        echo '</pre>';*/
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
}