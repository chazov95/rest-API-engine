<?php

namespace App\Model\Input\Request;

use App\Core\Abstractions\AbstractRequestDto;
use App\Core\Transformations\Deserializer\ObjectArrayType;

class ContractMethodDto extends AbstractRequestDto
{
    #[ObjectArrayType(self::class)]
    public array $test;//TODO убрать - тестовое свойство
    public string $class;
    public string $classMethod;
    public string $requestMethod;
}