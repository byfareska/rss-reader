<?php

namespace App\Util;

use samejack\PHP\ArgvParser;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Adapter\NullAdapter;

final class DependencyInjection
{
    private ?AdapterInterface $cacheAdapter = null;
    private ?Config $config = null;
    private ?ArgvParser $argvParser = null;
    private ?Router $router = null;

    /**
     * Returns cache adapter
     * @return AdapterInterface
     */
    public function getCacheAdapter(): AdapterInterface
    {
        if ($this->cacheAdapter === null) {
            if ($_ENV['APP_ENV'] === 'prod') {//enable cache for prod
                $this->cacheAdapter = new FilesystemAdapter("app", 10 * 60, __DIR__ . "/../../var/cache");
            } else {
                $this->cacheAdapter = new NullAdapter();
            }
        }

        return $this->cacheAdapter;
    }

    /**
     * Returns config
     * @return Config
     */
    public function getConfig(): Config
    {
        if ($this->config === null)
            $this->config = new Config($this);

        return $this->config;
    }

    public function getArgvParser(): ArgvParser
    {
        if ($this->argvParser === null)
            $this->argvParser = new ArgvParser();

        return $this->argvParser;
    }

    public function getRouter(): Router
    {
        if ($this->router === null)
            $this->router = new Router($this);

        return $this->router;
    }
}