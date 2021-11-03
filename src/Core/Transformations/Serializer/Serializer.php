<?php

namespace App\Core\Transformations\Serializer;

use App\Core\Interfaces\SerializerInterface;

class Serializer implements SerializerInterface
{
    public function convertToJson(object $response)
    {
       return json_encode($response);
    }

    public function convertToArray(object $response)
    {
        // TODO: Implement convertToArray() method.
    }
}