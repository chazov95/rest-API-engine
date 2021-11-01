<?php

namespace App\Core\Data;

use JsonException;
use function json_decode;

class ConfigData
{
    public static array $parameters;

    /**
     * @return array
     * @throws \App\Core\Data\ConfigDataException
     */
    public static function loadParameters(): array
    {
        try {
            return json_decode(
                file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/../config/parameters.json'),
                true,
                512,
                JSON_THROW_ON_ERROR
            );
        }
        catch (JsonException $exception) {
            throw new ConfigDataException($exception->getMessage());
        }
    }

    /**
     * @throws \App\Core\Data\ConfigDataException
     */
    public static function loadTagServicesConfigs(): array
    {
        try {
            return json_decode(
                file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/../config/tagServices.json'),
                true,
                512,
                JSON_THROW_ON_ERROR
            );
        }
        catch (JsonException $exception){
            throw new ConfigDataException($exception->getMessage());
        }
    }

    /**
     * @throws \App\Core\Data\ConfigDataException
     */
    public static function loadFqnServicesConfigs(): array
    {
        try {
            return json_decode(
                file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/../config/fqnServices.json'),
                true,
                512,
                JSON_THROW_ON_ERROR
            );
        }
        catch (JsonException $exception){
            throw new ConfigDataException($exception->getMessage());
        }
    }

    public static function getServiceNameByInterfaceFqn(string $getName): string
    {
    }
}