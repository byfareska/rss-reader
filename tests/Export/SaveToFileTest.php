<?php

namespace Tests\Export;

use App\Export\SaveToFile;
use App\Util\DependencyInjection;
use PHPUnit\Framework\TestCase;

class SaveToFileTest extends TestCase
{

    public function testGetOutputDir(): void
    {
        $di = new DependencyInjection();
        $save = new SaveToFile($di, "test", "txt", uniqid(), sys_get_temp_dir());
        $this->assertEquals(sys_get_temp_dir(), $save->getOutputDir());
    }

    public function testSave(): void
    {
        $di = new DependencyInjection();
        $save = new SaveToFile($di, "test", "txt", uniqid(), sys_get_temp_dir());
        $this->assertTrue($save->save());
    }

    public function testGetExtension(): void
    {
        $di = new DependencyInjection();
        $save = new SaveToFile($di, "test", "txt", uniqid(), sys_get_temp_dir());
        $this->assertEquals("txt", $save->getExtension());
    }

    public function testGetPath(): void
    {
        $di = new DependencyInjection();
        $ext = "txt";
        $fn = uniqid();
        $dir = sys_get_temp_dir();
        $save = new SaveToFile($di, "test", $ext, $fn, $dir);
        $this->assertEquals("{$dir}/{$fn}.{$ext}", $save->getPath());
    }

    public function testGetFileName(): void
    {
        $di = new DependencyInjection();
        $fn = uniqid();
        $save = new SaveToFile($di, "test", "txt", $fn, sys_get_temp_dir());
        $this->assertEquals($fn, $save->getFileName());
    }

    public function testGetFileNameWithExtension(): void
    {
        $di = new DependencyInjection();
        $fn = uniqid();
        $ext = "txt";
        $save = new SaveToFile($di, "test", $ext, $fn, sys_get_temp_dir());
        $this->assertEquals("{$fn}.{$ext}", $save->getFileNameWithExtension());
    }
}
