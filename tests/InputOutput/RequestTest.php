<?php

namespace Tests\InputOutput;

use App\InputOutput\Request;
use App\Util\DependencyInjection;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{

    public function testGetMethod()
    {
        $di = new DependencyInjection();

        $array = $di->getConfig()->get("commands");
        $item = reset($array);
        $explode = explode("::", $item["controller"]);

        $req = new Request($di, ["bin/console", $item['path']]);

        $this->assertEquals($explode[1], $req->getMethod());
    }

    public function testGetClass()
    {
        $di = new DependencyInjection();

        $array = $di->getConfig()->get("commands");
        $item = reset($array);
        $explode = explode("::", $item["controller"]);

        $req = new Request($di, ["bin/console", $item['path']]);

        $this->assertEquals($explode[0], $req->getClass());
    }

    public function testGetArgs()
    {
        $di = new DependencyInjection();

        $array = $di->getConfig()->get("commands");
        $item = reset($array);

        $req = new Request($di, ["bin/console", $item['path'], "--test=itworks"]);

        $this->assertContains("itworks", $req->getArgs());
    }
}
