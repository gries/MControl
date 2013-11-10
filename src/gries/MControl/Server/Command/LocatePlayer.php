<?php

namespace gries\MControl\Server\Command;

use gries\MControl\Server\Command\Teleport;
use gries\MControl\Server\Command\ResponseParser\LocatePlayerParser;

class LocatePlayer extends Teleport
{
    public function getResponseParser()
    {
        return new LocatePlayerParser($this->parameters['subjects'][0]);
    }
}
