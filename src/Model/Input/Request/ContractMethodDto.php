<?php

namespace App\Model\Input\Request;

use App\Core\Abstractions\AbstractRequestDto;

class ContractMethodDto extends AbstractRequestDto
{
    public string $class;
    public string $classMethod;
    public string $requestMethod;
}