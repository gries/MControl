<?php

namespace gries\MControl\Server\Command;

use gries\MControl\Server\Command\ResponseParser\ResponseParserInterface;

/**
 * Class Raw
 *
 * Use this command to execute raw-rcon commands on the server.
 *
 * @package gries\MControl\Server\Command
 */
class Raw implements CommandInterface
{
    protected $commandString;

    /**
     * @param $commandString
     */
    public function __construct($commandString)
    {
       $this->commandString = $commandString;
    }

    public function getCommandString()
    {
        return $this->commandString;
    }

    /**
     * Get the parser responsible for interpreting the server output
     * after the command is executed.
     *
     * If null is returned no parsing is done
     *
     * @return ResponseParserInterface / null
     */
    public function getResponseParser()
    {
        return null;
    }
}
