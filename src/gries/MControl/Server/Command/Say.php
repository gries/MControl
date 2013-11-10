<?php
namespace gries\MControl\Server\Command;

/**
 * Represents a Say Command that shows a Message to all Players on the Server
 */
class Say implements Command
{
    public function __construct($text)
    {
        $this->parameters['text'] = $text;
    }

    /**
     * @return string
     */
    public function getCommandString()
    {
        return sprintf('say %s', $this->parameters['text']);
    }

    /**
     * @return ResponseParser\ResponseParserInterface|null
     */
    public function getResponseParser()
    {
        return null;
    }
}