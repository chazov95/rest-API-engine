<?php

namespace App\Core\Data;

class ConfigData
{
    public static $parameters;
    public static $services;

    public static function loadParameters(): void
    {
        self::$parameters = yaml_parse_file($_SERVER['DOCUMENT_ROOT'] . '/config/parameters.yml');
    }

    public static function loadRoutes(): array
    {
        return yaml_parse_file($_SERVER['DOCUMENT_ROOT'] . '/config/routes.yml');
    }

    public static function loadServicesConfigs(): array
    {
        return yaml_parse_file($_SERVER['DOCUMENT_ROOT'] . '/config/services.yml');
    }
}