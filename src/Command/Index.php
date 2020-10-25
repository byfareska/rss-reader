<?php

namespace App\Command;

final class Index extends AbstractCommand
{
    /**
     * Lists available commands
     * @return int
     */
    public function index(): int
    {
        echo "Available commands:\n";

        foreach ($this->di->getConfig()->get('commands') as $cmd)
            echo "{$cmd['path']} - {$cmd['description']}\n";

        return self::EXIT_CODE_OK;
    }
}