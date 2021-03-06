<?php

namespace App\Core\Transformations\Deserializer;

use App\Core\Transformations\ModelProperty;
use App\Core\Transformations\PropertyType;

class Deserializer
{

    /**
     * @param array
     * @param string $getName
     *
     * @return object
     * @throws \ReflectionException|\App\Core\Transformations\Deserializer\DeserializerException
     */
    public function convertToObject(array $request, string $getName): object
    {
        $reflectionClass = new \ReflectionClass($getName);
        $instance = $reflectionClass->newInstance();

        $properties = $reflectionClass->getProperties();

        foreach ($properties as $property) {
            $propertyName = $property->getName();

            if (!isset($request[$propertyName])) {
                continue;
            }

            if ($property->getType()?->getName() === 'array') {
                $propertyAttributes = $property->getAttributes();

                foreach ($propertyAttributes as $attribute) {
                    if ($attribute->getName() === ModelProperty::class) {

                        /** @var \App\Core\Transformations\ModelProperty $modelProperty */
                        $modelProperty = $attribute->newInstance();

                        if ($modelProperty->type === PropertyType::objectArray) {
                            $objectsArray = [];

                            foreach ($request[$property->getName()] as $objectJson) {
                                $objectsArray[] = $this->convertToObject(
                                    $objectJson, //TODO надо затестить такой подход
                                    $modelProperty->fqn
                                );
                            }

                            $propertyValue = $objectsArray;
                            break;
                        }

                        break;
                    }
                }
            } else {
                $propertyValue = $this->conversionToType($property->getType()?->getName() ?? '', $request[$propertyName]) ;
            }

            if (isset($request[$propertyName]) && !empty($propertyValue)) {
                $instance->$propertyName = $propertyValue;
            }
        }

        return $instance;
    }

    /**
     * @throws \App\Core\Transformations\Deserializer\DeserializerException
     */
    private function conversionToType(string $type, mixed $value): float|bool|int|string
    {
        return match ($type) {
            'string' => (string) $value,
            'bool', 'boolean' => (boolean) $value,
            'float', 'double' => (float) $value,
            'int', 'integer' => (int) $value,
            default => throw new DeserializerException(sprintf("Can't cast value %s", $value)),
        };
    }
}