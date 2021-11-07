<?php

namespace App\Model\Input\Request;

use App\Core\Abstractions\AbstractRequestDto;
use App\Core\Transformations\ModelProperty;
use App\Core\Transformations\PropertyType;

class ContractMethodDto extends AbstractRequestDto
{
    #[ModelProperty(PropertyType::objectArray, self::class)]
    public array $test;//TODO убрать - тестовое свойство
    public string $class;
    public string $classMethod;
    public string $requestMethod;
}