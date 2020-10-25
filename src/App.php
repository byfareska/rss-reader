<?php

namespace App;

use App\Util\DependencyInjection;
use App\Util\Router;
use Symfony\Component\Dotenv\Dotenv;

class App
{
    private DependencyInjection $di;
    private Router $router;
    private array $argv;

    public function __construct(array $argv = [])
    {
        $this->bootstrap();
        $this->di = new DependencyInjection();
        $this->router = new Router($this->di);
        $this->argv = $argv;
    }

    /**
     * Executes command and returns status
     * @return int
     */
    public function run(): int
    {
        $explode = explode("::", $this->router->getController(@$this->argv[1]));
        $class = $explode[0];
        $method = $explode[1];
        return (new $class($this->di))->$method();
    }

    private function bootstrap()
    {
        require __DIR__ . "/bootstrap.php";
    }
}
