<?php

namespace App\Model\Db\ApiContractModel\Definitions;

use App\Core\Transformations\ModelProperty;
use App\Core\Transformations\PropertyType;
use App\Model\Input\Response\AbstractInputResponse;

class Property
{
    public string $type;
    public string $example;
    public string $description;

    #[ModelProperty(
        type: PropertyType::string,
        name: '$ref'
    )]
    public string $ref;
}
