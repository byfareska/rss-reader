<?php

namespace Tests\Command;

use App\Command\Index;
use App\InputOutput\Request;
use App\InputOutput\Response;
use App\Util\DependencyInjection;
use PHPUnit\Framework\TestCase;

class IndexTest extends TestCase
{
    public function testIndex()
    {
        $di = new DependencyInjection();
        $cmd = new Index($di, new Request($di, []));
        $this->assertEquals(Response::EXIT_CODE_OK, $cmd->index()->getExitCode());
    }
}
