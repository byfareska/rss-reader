<?php

namespace App\Util;

use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Yaml\Yaml;
use Symfony\Contracts\Cache\ItemInterface;

final class Config
{
    private AdapterInterface $cache;
    private array $config;

    public function __construct(DependencyInjection $di)
    {
        $this->cache = $di->getCacheAdapter();
        $this->config = $this->getConfig();
    }

    /**
     * Returns key value from config files
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        return $this->config[$key];
    }

    /**
     * Returns config using cache
     * @return array
     */
    private function getConfig(): array
    {
        return $this->cache->get("APP_CONFIG", function (ItemInterface $item) {
            $item->expiresAfter(24 * 60 * 60);
            return $this->loadConfig();
        });
    }

    /**
     * Returns config
     * @return array
     */
    private function loadConfig(): array
    {
        $config = [];

        foreach ($this->getConfigFiles() as $file) {
            $config = array_merge_recursive($config, Yaml::parseFile($file));
        }

        return $config;
    }

    /**
     * Lists all *.yaml files inside config directory
     * @return array
     */
    private function getConfigFiles(): array
    {
        return glob(__DIR__ . "/../../config/*.yaml") ?: [];
    }
}