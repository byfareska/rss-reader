<?php

namespace Tests\Util;

use App\Util\Config;
use App\Util\DependencyInjection;
use PHPUnit\Framework\TestCase;

final class ConfigTest extends TestCase
{
    public function testRun(): void
    {
        $someParams = [
            "default_command",
            "commands"
        ];

        $config = new Config(new DependencyInjection());

        foreach ($someParams as $param)
            $this->assertNotEmpty($config->get($param));
    }
}