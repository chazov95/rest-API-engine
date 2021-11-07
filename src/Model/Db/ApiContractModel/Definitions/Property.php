<?php

namespace App\Model\Db\ApiContractModel\Definitions;

use App\Core\Transformations\ModelProperty;
use App\Core\Transformations\PropertyType;

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
