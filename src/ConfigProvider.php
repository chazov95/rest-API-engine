<?php

namespace App;

class ConfigProvider
{
    /**
     * @return string
     */
    public static function getDefaultFilePath(): string
    {
        return __DIR__ . '/logs';
    }
}