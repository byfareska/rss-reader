<?php

namespace Tests\Export\Export;

use App\Export\Export\ExportFeed;
use App\Export\Writer\CsvWriter;
use App\Feed\Feed;
use App\Util\DependencyInjection;
use PHPUnit\Framework\TestCase;

class ExportFeedTest extends TestCase
{
    public function testGetContents(): void
    {
        $di = new DependencyInjection();
        $array = $di->getConfig()->get("feeds");
        $item = reset($array);
        $ef = new ExportFeed(new Feed($item['url']));

        $this->assertIsArray($ef->getContents());
        $this->assertNotEmpty($ef->getContents());
    }

    public function testExport(): void
    {
        $di = new DependencyInjection();
        $array = $di->getConfig()->get("feeds");
        $item = reset($array);
        $ef = new ExportFeed(new Feed($item['url']));

        $this->assertIsString($ef->export(new CsvWriter()));
    }

}
