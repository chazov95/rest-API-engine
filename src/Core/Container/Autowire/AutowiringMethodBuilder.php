<?php

namespace App\Core\Container\Autowire;

use App\Core\Interfaces\BuilderInterface;

class AutowiringMethodBuilder implements BuilderInterface
{
    /**
     * @var \App\Core\Container\Autowire\AutowiringMethodBuilder|null
     */
    private static ?AutowiringMethodBuilder $builder = null;
    private ?array                         $arguments = null;
    private string                         $Fqn;
    private string                         $method;

    /**
     * @return \App\Core\Container\Autowire\AutowiringMethodBuilder
     */
    public static function getInstance(): AutowiringMethodBuilder
    {
        if (self::$builder === null) {
            self::$builder = new self();
        }

        return self::$builder;
    }

    /**
     * @return \App\Core\Interfaces\BuilderInterface
     */
    public function build(): BuilderInterface
    {
       return $this;
    }

    /**
     * @return \App\Core\Interfaces\BuilderInterface
     */
    public function reset(): BuilderInterface
    {
        $this->arguments = null;

        return $this;
    }

    /**
     * @return array
     */
    public function getResult(): array
    {
        $result = $this->arguments ?? [];
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

    /**
     * @param string $method
     *
     * @return $this
     */
    public function setMethod(string $method): static
    {
        $this->method = $method;

        return $this;
    }
}