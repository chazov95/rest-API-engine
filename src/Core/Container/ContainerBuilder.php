<?php

namespace App\Core\Container;


use Component\Builder\BuilderInterface;

class ContainerBuilder implements BuilderInterface
{
    /**
     * @var BuilderInterface
     */
    private static BuilderInterface $builder;

    /**
     * @var array
     */
    private array $serviceConfig;

    private function __construct()
    {
    }

    /**
     * @return \App\Core\Container\ContainerBuilder
     */
    public static function get(): ContainerBuilder
    {
        if (self::$builder === null) {
            self::$builder = new self();
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
        // TODO: Implement build() method.
    }

    public function reset(): BuilderInterface
    {
        // TODO: Implement reset() method.
    }

    public function getResult()
    {
        // TODO: Implement getResult() method.
    }
}