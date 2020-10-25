<?php

namespace App\Command;

use App\Feed\Feed;
use App\InputOutput\Response;

class FetchRss extends AbstractCommand
{
    public function index(): Response
    {
        $feedName = @$this->request->getArgs()['feed'];
        $limit = @$this->request->getArgs()['limit'] ?: 5;

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

        $this->response->say("Latest news from {$feedName}:");

        foreach ($feed->getFeed() as $i => $item) {
            if ($i >= $limit)
                break;

            $this->response->say("{$item->getTitle()} - {$item->getLink()}");
        }


        return $this->response;
    }
}