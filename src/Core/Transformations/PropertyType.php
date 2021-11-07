<?php

namespace App\Core\Transformations;

class PropertyType
{
    public const object = 'object';
    public const string = 'string';
    public const bool = 'bool';
    public const int = 'integer';
    public const float = 'float';

    /**
     * for generate dynamic properties in StdClass
     */
    public const assocArray = 'assocArray';
    public const objectArray = 'objectArray';
    public const stringArray = 'stringArray';
    public const boolArray = 'boolArray';
    public const intArray = 'intArray';
    public const floatArray = 'floatArray';
}