<?php

namespace App\Core\Route;

use App\Core\Container\Autowire\AutowiringClassBuilder;
use App\Core\Container\Autowire\AutowiringMethodBuilder;

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
     * Тип роута: api или html
     *
     * @var string
     */
    public string $type;

    public function execute(): void
    {
        $object = AutowiringClassBuilder::getInstance()->setFqn($this->class)->build()->getResult();
        $methodsArguments = AutowiringMethodBuilder::getInstance()
            ->setFqn($this->class)
            ->setMethod($this->method)
            ->build()
            ->getResult();

        echo call_user_func_array([$object, $this->method], $methodsArguments);
    }
}