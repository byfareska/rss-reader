<?php

namespace App\Export\Writer;

use App\Export\Export\ExportInterface;

interface WriterInterface
{
    public function write(ExportInterface $export): string;
}