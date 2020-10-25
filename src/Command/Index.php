<?php

namespace App\Command;

use App\InputOutput\Response;

final class Index extends AbstractCommand
{
    /**
     * Lists available commands
     * @return Response
     */
    public function index(): Response
    {
        $this->response->say("Available commands:");

        foreach ($this->di->getConfig()->get('commands') as $cmd)
            $this->response->say("{$cmd['path']} - {$cmd['description']}");

        return $this->response;
    }
}