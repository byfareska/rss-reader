<?php

namespace Tests\App\Util;

use App\Util\Config;
use App\Util\DependencyInjection;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class DependencyInjectionTest extends TestCase
{

    public function testGetCacheAdapter(): void
    {
        $di = new DependencyInjection();
        $this->assertInstanceOf(AdapterInterface::class, $di->getCacheAdapter());
    }

    public function testGetConfig(): void
    {
        $di = new DependencyInjection();
        $this->assertInstanceOf(Config::class, $di->getConfig());
    }
}
