<?php

namespace App\Core\Container\Autowire;

use App\Component\Logger\LogLevels;
use App\Core\Abstractions\AbstractRequestDto;
use App\Core\Core;
use App\Core\Interfaces\BuilderInterface;
use App\Core\Request;
use App\Core\Transformations\Deserializer\Deserializer;
use ReflectionClass;
use ReflectionMethod;

class AutowiringMethodBuilder extends AbstractAutowiring implements BuilderInterface
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
     * @throws \ReflectionException
     */
    public function build(): BuilderInterface
    {
        $reflectionMethod = new ReflectionMethod($this->Fqn, $this->method);
        $methodParameters = $reflectionMethod->getParameters();

        $abstractRequestDtoCounter = 0;

        foreach ($methodParameters as $parameter) {
            $parameterType = $parameter->getType();

            if ($parameterType=== null) {
                //TODO выбросить exception?
            }

            $parameterClassReflection = new \ReflectionClass($parameterType->getName());
            $parentClass = $parameterClassReflection->getParentClass();

            if ($parentClass instanceof ReflectionClass && $parentClass->getName() === AbstractRequestDto::class) {
                $abstractRequestDtoCounter++;

                if ($abstractRequestDtoCounter > 1) {
                    throw new AutowiringException('Controllers can accept only one request DTO');
                }

                $this->creacteRequestModel($parameterClassReflection);
            }

        }

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

    /**
     * @throws \App\Core\Container\ContainerException|\App\Core\Container\Autowire\AutowiringException
     */
    private function creacteRequestModel(ReflectionClass $dtoReflection): object
    {
        $simpleContainer = Core::getSimpleContainer();

        if (!$simpleContainer->has(Deserializer::class)) {
            throw new AutowiringException(
                'Serializer not allowed',
                500,
                'CORE_EXCEPTION',
                LogLevels::ERROR
            );
        }

        /** @var Deserializer $deserializer */
        $deserializer = $simpleContainer->get(Deserializer::class);

        return $deserializer->convertToObject(Request::getInstance()->getRequestBody(), $dtoReflection->getName());
    }
}