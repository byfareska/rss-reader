<?php

namespace Tests\App\Command;

use App\Command\AbstractCommand;
use App\Command\Index;
use App\Util\DependencyInjection;
use PHPUnit\Framework\TestCase;

class IndexTest extends TestCase
{
    public function testIndex()
    {
        $cmd = new Index(new DependencyInjection());
        $this->assertEquals(AbstractCommand::EXIT_CODE_OK, $cmd->index());
    }
}
