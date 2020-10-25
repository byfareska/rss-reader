<?php

namespace Tests;

use App\App;
use App\InputOutput\Response;
use PHPUnit\Framework\TestCase;

final class AppTest extends TestCase
{
    public function testRun(): void
    {
        $app = new App();
        $this->assertEquals(Response::EXIT_CODE_OK, $app->run());
    }
}
