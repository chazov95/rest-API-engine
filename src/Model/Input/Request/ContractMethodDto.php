<?php

namespace App\Model\Input\Request;

use App\Core\Abstractions\AbstractDto;

class ContractMethodDto extends AbstractDto
{
    public string $class;
    public string $classMethod;
    public string $requestMethod;
}