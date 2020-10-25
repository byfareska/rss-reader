<?php

namespace Tests\Util;

use App\Util\Config;
use App\Util\DependencyInjection;
use App\Util\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    public function testGetController()
    {
        $di = new DependencyInjection();
        $config = new Config($di);
        $router = new Router($di);
        $this->assertEquals($router->getControllerByName($config->get("default_command")), $router->getController(null));
    }

    public function testGetDefaultController()
    {
        $di = new DependencyInjection();
        $config = new Config($di);
        $router = new Router($di);
        $this->assertEquals($router->getControllerByName($config->get("default_command")), $router->getDefaultController());
    }
}
