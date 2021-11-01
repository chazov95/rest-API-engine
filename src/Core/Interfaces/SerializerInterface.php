<?php

namespace App\Core\Interfaces;

interface SerializerInterface
{
    public function convertToJson(object $response);
    public function convertToArray(object $response);
}