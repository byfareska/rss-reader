<?php

namespace Tests\Command;

use App\Command\FetchRss;
use App\InputOutput\Request;
use App\InputOutput\Response;
use App\Util\DependencyInjection;
use PHPUnit\Framework\TestCase;

class FetchRssTest extends TestCase
{
    public function testIndex()
    {
        $di = new DependencyInjection();
        $cmd = new FetchRss($di, new Request($di, ["--feed=national geographic"]));
        $this->assertEquals(Response::EXIT_CODE_OK, $cmd->index()->getExitCode());
    }
}
