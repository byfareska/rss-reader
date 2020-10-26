<?php

namespace App\Export\Export;

use App\Export\Writer\WriterInterface;

abstract class ExportDecorator implements ExportInterface
{
    abstract public function getContents(): array;

    public function export(WriterInterface $writer): string
    {
        return $writer->write($this);
    }
}