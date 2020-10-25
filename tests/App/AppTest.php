<?php

namespace Tests\App;

use App\App;
use App\Command\AbstractCommand;
use PHPUnit\Framework\TestCase;

final class AppTest extends TestCase
{
    public function testRun(): void
    {
        $app = new App();
        $this->assertEquals(AbstractCommand::EXIT_CODE_OK, $app->run());
    }
}
