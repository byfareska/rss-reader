<?php

namespace App\Command;

use App\Export\Export\ExportFeed;
use App\Export\SaveToFile;
use App\Export\Writer\CsvWriter;
use App\Feed\Feed;
use App\InputOutput\Response;

final class FetchRss extends AbstractCommand
{
    public function index(): Response
    {
        $feedName = @$this->request->getArgs()['feed'];

        if ($feedName === null) {
            return $this->response
                ->setExitCode(Response::EXIT_CODE_MISSING_ARG)
                ->say("Missing `feed` param");
        }

        $feed = Feed::getByName($feedName, $this->di);

        if ($feed === null) {
            return $this->response
                ->setExitCode(Response::EXIT_CODE_NOT_FOUND)
                ->say("Can't find `{$feedName}` feed.");
        }

        $export = new ExportFeed($feed);
        $csv = $export->export(new CsvWriter());
        $save = new SaveToFile($this->di, $csv, "csv");

        if ($save->save()) {
            $this->response->say("Saved as {$save->getPath()}");
        } else {
            $this->response->say("Failed to save to file.");
            $this->response->setExitCode(Response::EXIT_CODE_ERROR);
        }

        return $this->response;
    }
}