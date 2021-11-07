<?php

namespace App\Model\Db\ApiContractModel;

use App\Core\Transformations\ModelProperty;
use App\Core\Transformations\PropertyType;
use App\Model\Db\ApiContractModel\Definitions\Property;

class Definition
{
    public string $type;

    #[ModelProperty(PropertyType::assocArray, Property::class)]
    public string $properties;
}