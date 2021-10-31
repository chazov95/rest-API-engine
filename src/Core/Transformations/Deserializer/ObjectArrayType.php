<?php

namespace App\Core\Transformations\Deserializer;

#[\Attribute] class ObjectArrayType
{
    public function __construct(
        public string $fqn
    ) {
    }
}