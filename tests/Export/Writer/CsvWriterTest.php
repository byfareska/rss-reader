<?php

namespace Tests\Export\Writer;

use App\Export\Export\ExportFeed;
use App\Export\Writer\CsvWriter;
use App\Feed\Feed;
use App\Util\DependencyInjection;
use PHPUnit\Framework\TestCase;

class CsvWriterTest extends TestCase
{

    public function testWrite(): void
    {
        $di = new DependencyInjection();
        $array = $di->getConfig()->get("feeds");
        $item = reset($array);
        $ef = new ExportFeed(new Feed($item['url']));

        $this->assertIsString($ef->export(new CsvWriter()));
    }
}
