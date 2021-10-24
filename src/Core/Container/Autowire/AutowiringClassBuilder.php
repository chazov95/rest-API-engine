<?php

namespace App\Core\Container\Autowire;

use App\Core\Container\ContainerException;
use App\Core\Interfaces\BuilderInterface;

class AutowiringClassBuilder extends AbstractAutowiring implements BuilderInterface
{
    /**
     * @var \App\Core\Container\Autowire\AutowiringClassBuilder|null
     */
    private static ?AutowiringClassBuilder $builder = null;
    private ?object                        $object;
    private string                         $Fqn;

    private function __construct()
    {
    }

    /**
     * @return \App\Core\Container\Autowire\AutowiringClassBuilder
     */
    public static function getInstance(): AutowiringClassBuilder
    {
        if (self::$builder === null) {
            self::$builder = new self();
        }

        return self::$builder;
    }

    /**
     * @return \App\Core\Interfaces\BuilderInterface
     * @throws \App\Core\Container\Autowire\AutowiringException
     * @throws \App\Core\Container\ContainerException
     * @throws \ReflectionException
     */
    public function build(): BuilderInterface
    {
        $this->object = $this->createServiceByFqn($this->Fqn);

        return $this;
    }

    public function reset(): BuilderInterface
    {
        $this->object = null;

        return $this;
    }

    /**
     * @return object|null
     */
    public function getResult(): ?object
    {
        $result = $this->object;
        $this->reset();

        return $result;
    }

    /**
     * @param string $className
     *
     * @return $this
     */
    public function setFqn(string $className): static
    {
        $this->Fqn = $className;

        return $this;
    }
}