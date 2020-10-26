<?php

namespace App\Export;

use App\Util\DependencyInjection;

class SaveToFile
{
    private DependencyInjection $di;
    private string $extension;
    private string $fileName;
    private string $outputDir;
    private string $content;

    public function __construct(DependencyInjection $di, string $content, string $extension, ?string $proposedFileName = null, ?string $outputDir = null)
    {
        $this->di = $di;
        $this->content = $content;
        $this->extension = $extension;
        $this->outputDir = $outputDir === null ? "{$this->di->getConfig()->get("output_path")}" : $outputDir;
        $this->fileName = $this->createFileName($proposedFileName);
    }

    public function save(): bool
    {
        if (!$this->createDirIfNeeded())
            return false;

        return (bool)file_put_contents($this->getPath(), $this->content);
    }

    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * @return string File name without extension
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function getFileNameWithExtension(): string
    {
        return "{$this->fileName}.{$this->extension}";
    }

    public function getPath(): string
    {
        return "{$this->outputDir}/{$this->fileName}.{$this->extension}";
    }

    public function getOutputDir(): string
    {
        return $this->outputDir;
    }

    private function createFileName(?string $proposedFileName): string
    {
        if ($proposedFileName === null)
            $proposedFileName = uniqid();

        $i = 1;

        do {
            $fileName = $proposedFileName;

            if ($i > 1)
                $fileName .= ".{$i}";

            ++$i;
        } while (file_exists("{$this->outputDir}/{$fileName}.{$this->extension}"));

        return $fileName;
    }

    private function createDirIfNeeded(): bool
    {
        if (!file_exists($this->outputDir))
            return mkdir($this->outputDir, 0777, true);

        return true;
    }

}