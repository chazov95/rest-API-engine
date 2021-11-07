<?php

namespace App\Core\Transformations;

#[\Attribute] class ModelProperty
{
    public function __construct(
        public string $type,
        public ?string $fqn = '',
        public ?string $name = '',
        public ?string $example = '',
        public ?string $description = ''
    ) {
    }
}
