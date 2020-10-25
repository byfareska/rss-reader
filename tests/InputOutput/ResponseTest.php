<?php

namespace Tests\InputOutput;

use App\InputOutput\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{

    public function testSetExitCode()
    {
        $resp = new Response();
        $resp->setExitCode(Response::EXIT_CODE_NOT_FOUND);
        $this->assertEquals(Response::EXIT_CODE_NOT_FOUND, $resp->getExitCode());
    }

    public function testSay()
    {
        $msg = "Man doesn’t balanced develop any sun — but the aspect is what converts.";
        $resp = new Response();
        $resp->say($msg);
        $this->assertContains($msg, $resp->getMessages());
    }

    public function testGetMessages()
    {
        $this->testSay();
    }

    public function testGetExitCode()
    {
        $this->testSetExitCode();
    }
}
