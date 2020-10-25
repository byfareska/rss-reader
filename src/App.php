<?php

namespace App;

use App\InputOutput\Request;
use App\Util\DependencyInjection;

final class App
{
    private DependencyInjection $di;
    private Request $request;

    public function __construct(array $argv = [])
    {
        $this->bootstrap();
        $this->di = new DependencyInjection();
        $this->request = new Request($this->di, $argv);
    }

    /**
     * Executes command and returns status
     * @return int
     */
    public function run(): int
    {
        $class = $this->request->getClass();
        $method = $this->request->getMethod();

        return (new $class($this->di, $this->request))->$method()->getExitCode();
    }

    private function bootstrap(): void
    {
        require __DIR__ . "/bootstrap.php";
    }
}
