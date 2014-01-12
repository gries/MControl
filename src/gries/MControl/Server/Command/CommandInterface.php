<?php
namespace gries\MControl\Server\Command;
use gries\MControl\Server\Command\ResponseParser\ResponseParserInterface;

/**
 * Represents a Mincraft Command like: say, tp, give.
 *
 * Methods a child class has to implement:
 *     - getCommandString
 *  - getResponseParser
 *
 * To get the complete command output use the toString method or getCommandString.
 */
interface CommandInterface
{
    /**
     * Get the rendered command like: "say hello world!"
     *
     * @return string
     */
    public function getCommandString();

    /**
     * Get the parser responsible for interpreting the server output
     * after the command is executed.
     *
     * If null is returned no parsing is done
     *
     * @return ResponseParserInterface / null
     */
    public function getResponseParser();
}