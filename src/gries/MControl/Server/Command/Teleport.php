<?php
namespace gries\MControl\Server\Command;
use gries\MControl\Server\Command\ResponseParser\LocatePlayerParser;

/**
 * Represents a "TP" Command that teleports a player to another player or some given coordinates
 */
class Teleport implements Command
{
    public function __construct(array $subjects)
    {
        $this->parameters['subjects'] = $subjects;
    }

    public function getCommandString()
    {
        $subjectCount = count($this->parameters['subjects']);

        if ($subjectCount > 4 || $subjectCount < 2) {
            throw new \InvalidArgumentException('Invalid number of teleporting Subjects!');
        }

        return sprintf('tp %s', implode(' ', $this->parameters['subjects']));
    }

    /**
     * @return ResponseParser\ResponseParserInterface|null
     */
    public function getResponseParser()
    {
        return null;
    }
}