<?php

namespace gries\MControl\Server\Command;

use gries\MControl\Builder\BlockType;
use gries\MControl\Server\Command\ResponseParser\ResponseParserInterface;
use gries\MControl\Server\Command\ResponseParser\TestForBlockParser;

class TestForBlock implements Command
{
    protected $blockType;

    protected $coordinates;

    protected $meta;

    public function __construct(array $coordinates, BlockType $blockType, $meta = null)
    {
        $this->blockType   = $blockType;
        $this->coordinates = $coordinates;
        $this->meta        = $meta;
    }

    public function getCommandString()
    {
        $command = sprintf(
            'testforblock %s %s %s %s',
            $this->coordinates['x'],
            $this->coordinates['y'],
            $this->coordinates['z'],
            $this->blockType->getName()
        );

        if (null !== $this->meta) {
            $command .= ' '.$this->meta;
        }

        return $command;
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
        return new TestForBlockParser();
    }
}
