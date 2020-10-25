<?php

namespace App\Command;

use App\InputOutput\Request;
use App\InputOutput\Response;
use App\Util\DependencyInjection;

abstract class AbstractCommand
{
    protected DependencyInjection $di;
    protected Request $request;
    protected Response $response;

    public function __construct(DependencyInjection $di, Request $request)
    {
        $this->di = $di;
        $this->request = $request;
        $this->response = new Response();
    }
}