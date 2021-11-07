<?php

namespace App\Model\Db\ApiContractModel\Paths;

use App\Core\Transformations\ModelProperty;
use App\Core\Transformations\PropertyType;
use App\Model\Db\ApiContractModel\Paths\Path\Parameter;
use App\Model\Db\ApiContractModel\Paths\Path\Response;

class Path
{
    public array $tags;
    public string $summary;
    public string $description;
    public string $operationId;
    public array $produces = ['application/json'];

    #[ModelProperty(PropertyType::objectArray, Parameter::class)]
    public array $parameters;

    #[ModelProperty(PropertyType::assocArray, Response::class)]
    public array $responses;
}