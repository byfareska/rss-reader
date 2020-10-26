<?php

namespace App\Export\Writer;

use App\Export\Export\ExportInterface;

class CsvWriter implements WriterInterface
{
    private ?ExportInterface $export = null;

    public function write(ExportInterface $export): string
    {
        $this->export = $export;
        $fileName = $this->saveToTmpFile();
        return file_get_contents($fileName);
    }

    /**
     * @return string Returns temporary file name with result
     */
    private function saveToTmpFile(): string
    {
        $tmpFileName = sys_get_temp_dir() . "/csv" . uniqid();
        $fopen = fopen($tmpFileName, 'w');

        foreach ($this->export->getContents() as $line)
            fputcsv($fopen, $line);

        fclose($fopen);
        return $tmpFileName;
    }
}