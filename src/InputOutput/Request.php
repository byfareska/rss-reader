<?php

namespace App\InputOutput;

use App\Util\DependencyInjection;

class Request
{
    private DependencyInjection $di;
    private string $class;
    private string $method;
    private array $args;

    public function __construct(DependencyInjection $di, array $argv)
    {
        $this->di = $di;
        $explode = explode("::", $di->getRouter()->getController(@$argv[1]));
        $this->class = $explode[0];
        $this->method = $explode[1];
        $this->args = $this->di->getArgvParser()->parseConfigs($argv);
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getArgs(): array
    {
        return $this->args;
    }
}