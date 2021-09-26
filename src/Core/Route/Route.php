<?php

namespace App\Core\Route;

class Route
{
    /**
     * @var string
     */
    public string $class;

    /**
     * @var string
     */
    public string $method;

    /**
     * @var string[]
     */
    public array $methodArguments;

    /**
     * @var string[]
     */
    public array $classArguments;

    /**
     * для роутов типа /example/1
     *
     * @var array
     */
    public array $uriValues;

    /**
     * @var array
     */
    public array $methodArgumentsValues;

    public function execute(): string
    {

    }
}