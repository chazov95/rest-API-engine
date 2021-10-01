<?php

namespace App\Core;

use App\Core\Container\Container;

class Core
{
    /**
     * @var Container
     */
    private static Container $customContainer;

    /** @var Container */
    private static Container $simpleContainew;

    /** @var Container */
    private static Container $serviceCreator;

    /** @var array */
    private static array $parameters;

    public static function setParameters(array $parameters)
    {
        self::$parameters = $parameters;
    }

    public static function getParameter(string $parameterName)
    {
    }

    /**
     * @return Container
     */
    public static function getServiceCreator(): Container
    {
        return self::$serviceCreator;
    }

    /**
     * @param Container $serviceCreator
     */
    public static function setServiceCreator(Container $serviceCreator): void
    {
        self::$serviceCreator = $serviceCreator;
    }

    /**
     * @return Container
     */
    public static function getSimpleContainew(): Container
    {
        return self::$simpleContainew;
    }

    /**
     * @param Container $simpleContainew
     */
    public static function setSimpleContainer(Container $simpleContainew): void
    {
        self::$simpleContainew = $simpleContainew;
    }

    /**
     * @return Container
     */
    public static function getCustomContainer(): Container
    {
        return self::$customContainer;
    }

    /**
     * @param Container $customContainer
     */
    public static function setCustomContainer(Container $customContainer): void
    {
        self::$customContainer = $customContainer;
    }
}