<?php

namespace App\Command;

use App\Util\DependencyInjection;

abstract class AbstractCommand
{
    public const EXIT_CODE_OK = 0;

    protected DependencyInjection $di;

    public function __construct(DependencyInjection $di)
    {
        $this->di = $di;
    }
}