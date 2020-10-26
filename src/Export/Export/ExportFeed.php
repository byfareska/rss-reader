<?php

namespace App\Export\Export;

use App\Feed\Feed;

class ExportFeed extends ExportDecorator
{
    private array $contents = [];

    public function __construct(Feed $feed)
    {
        foreach ($feed->getFeed() as $item){
            $this->contents[] = [
                $item->getTitle(),
                $item->getDescription(),
                $item->getLink()
            ];
        }
    }

    public function getContents(): array
    {
        return $this->contents;
    }
}