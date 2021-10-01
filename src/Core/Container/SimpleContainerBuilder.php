<?php

namespace App\Core\Container;

use App\Core\Interfaces\BuilderInterface;

class SimpleContainerBuilder implements BuilderInterface
{
    private static SimpleContainerBuilder $builder;

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

    public function build(): BuilderInterface
    {
        // TODO: Implement build() method.
    }

    public function reset(): BuilderInterface
    {
        // TODO: Implement reset() method.
    }

    public function getResult(): Container
    {
        // TODO: Implement getResult() method.
    }
}