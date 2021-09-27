<?php

namespace App\Core\Data;

use JsonException;
use function json_decode;
use App\Core\Data\ConfigDataException;

class ConfigData
{
    public static array $parameters;

    /**
     * @throws \App\Core\Data\ConfigDataException
     */
    public static function loadParameters(): void
    {
        try {
            self::$parameters = json_decode(
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
    public static function loadRoutes(): array
    {
        try {
            return json_decode(
                file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/../config/routes.json'),
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
    public static function loadServicesConfigs(): array
    {
        try {
            return json_decode(
                file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/../config/services.json'),
                true,
                512,
                JSON_THROW_ON_ERROR
            );
        }
        catch (JsonException $exception){
            throw new ConfigDataException($exception->getMessage());
        }
    }
}