<?php

namespace App\Feed;

use App\Util\DependencyInjection;
use FeedIo\Factory as FeedIoFactory;
use FeedIo\FeedInterface;
use FeedIo\Reader\Result;

final class Feed
{
    private string $url;
    private Result $result;

    public function __construct(string $url)
    {
        $this->url = $url;
        $this->result = FeedIoFactory::create()->getFeedIo()->read($url);
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getFeed(): FeedInterface
    {
        return $this->result->getFeed();
    }

    public static function getByName(string $name, DependencyInjection $di): ?self
    {
        $name = strtoupper($name);

        foreach ($di->getConfig()->get('feeds') as $feed) {
            if ($name === strtoupper($feed['name'])) {
                return new self($feed['url']);
            }
        }

        return null;
    }
}