<?php

namespace App\Export\Export;

use App\Export\Writer\WriterInterface;

interface ExportInterface
{
    public function getContents(): array;

    public function export(WriterInterface $strategy): string;
}