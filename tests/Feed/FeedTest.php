<?php

namespace Tests\Feed;

use App\Feed\Feed;
use App\Util\DependencyInjection;
use FeedIo\FeedInterface;
use PHPUnit\Framework\TestCase;

class FeedTest extends TestCase
{

    public function testGetByName(): void
    {
        $di = new DependencyInjection();
        $array = $di->getConfig()->get("feeds");
        $item = reset($array);
        $this->assertInstanceOf(Feed::class, Feed::getByName($item['name'], $di));
        $this->assertNull( Feed::getByName("not found 123404", $di));
    }

    public function testGetUrl()
    {
        $di = new DependencyInjection();
        $array = $di->getConfig()->get("feeds");
        $item = reset($array);
        $feed = Feed::getByName($item['name'], $di);
        $this->assertIsString($feed->getUrl());
    }

    public function testGetFeed()
    {
        $di = new DependencyInjection();
        $array = $di->getConfig()->get("feeds");
        $item = reset($array);
        $feed = Feed::getByName($item['name'], $di);
        $this->assertInstanceOf(FeedInterface::class, $feed->getFeed());
    }
}
