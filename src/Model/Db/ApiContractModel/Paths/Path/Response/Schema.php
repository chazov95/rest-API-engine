<?php

namespace App\Model\Db\ApiContractModel\Paths\Path\Response;

use App\Core\Transformations\ModelProperty;
use App\Core\Transformations\PropertyType;
use App\Model\Input\Response\AbstractInputResponse;

class Schema
{
    public string $type = 'object';

    #[ModelProperty(type: PropertyType::string, name: '$ref')]
    public AbstractInputResponse $ref;
}