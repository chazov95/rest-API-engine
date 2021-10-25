<?php

namespace App\Core\Transformations\Deserializer;

class Deserializer
{

    /**
     * @param array
     * @param string $getName
     *
     * @return object
     * @throws \ReflectionException
     */
    public function convertToObject(array $request, string $getName): object
    {
        $reflectionClass = new \ReflectionClass($getName);

        $properties = $reflectionClass->getProperties();

        foreach ($properties as $property) {
            $property->getName();
        }
    }
}