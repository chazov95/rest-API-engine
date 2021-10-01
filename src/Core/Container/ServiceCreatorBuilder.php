<?php

namespace App\Core\Container;

use App\Core\Interfaces\BuilderInterface;

class ServiceCreatorBuilder implements BuilderInterface
{
    private static ServiceCreatorBuilder $builder;

    /**
     * @return ServiceCreatorBuilder
     */
    public static function getInstance(): ServiceCreatorBuilder
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

    public function getResult(): mixed
    {
        // TODO: Implement getResult() method.
    }
}