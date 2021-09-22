<?php

namespace App\Core;

use App\Core\Container\Container;
use App\Core\Data\ConfigData;
use http\Env\Request;

class CoreLoader
{
    public function load()
    {
        ConfigData::loadParameters();
        ContainerBuilder::build(ConfigData::loadServicesConfigs());

        $route = RouteFactory::create(ConfigData::loadRoutes());
        $executableRoute = $this->autowireRoute($route);
        $this->executeRoute($executableRoute);
    }

    private function autowireRoute($route)
    {
    }
}