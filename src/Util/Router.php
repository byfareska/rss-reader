<?php

namespace App\Util;

final class Router
{
    private DependencyInjection $di;

    public function __construct(DependencyInjection $di)
    {
        $this->di = $di;
    }

    /**
     * Returns controller in \App\Namespace\Class::method format
     * @param string|null $path
     * @return string
     */
    public function getController(?string $path): string
    {
        if (empty($path))
            return $this->getDefaultController();

        foreach ($this->di->getConfig()->get("commands") as $name => $cmd) {
            if ($cmd['path'] === $path)
                return $cmd['controller'];
        }

        return $this->getDefaultController();
    }

    /**
     * Returns default controller in \App\Namespace\Class::method format
     * @return string
     */
    public function getDefaultController(): string
    {
        $default = $this->di->getConfig()->get("default_command");
        return $this->getControllerByName($default);
    }

    /**
     * Returns controller by it name in \App\Namespace\Class::method format
     * @param string $name
     * @return string
     */
    public function getControllerByName(string $name): string
    {
        return $this->di->getConfig()->get("commands")[$name]['controller'];
    }
}