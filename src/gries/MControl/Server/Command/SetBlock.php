<?php

namespace gries\MControl\Server\Command;

class SetBlock implements Command
{
    const SET_METHOD_KEEP = 'keep';

    const SET_METHOD_REPLACE = 'replace';

    const SET_METHOD_DELETE = 'delete';

    protected $coordinates;

    protected $blockType;

    protected $method;

    protected $meta;

    public function __construct($blockType, array $coordinates, $method, $meta = 0)
    {
        $this->coordinates = $coordinates;
        $this->blockType = $blockType;
        $this->method = $method;
        $this->meta = $meta;
    }

    public function getCommandString()
    {
        return sprintf(
            'setblock %d %d %d %s %s %s',
            $this->coordinates['x'],
            $this->coordinates['y'],
            $this->coordinates['z'],
            $this->blockType,
            $this->meta,
            $this->method
        );
    }

    public function getResponseParser()
    {
        return null;
    }
}
