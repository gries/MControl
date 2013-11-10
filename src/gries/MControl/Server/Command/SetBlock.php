<?php

namespace gries\MControl\Server\Command;

class SetBlock implements Command
{
    const SET_METHOD_KEEP = 'keep';

    const SET_METHOD_REPLACE = 'replace';

    const SET_METHOD_DELETE = 'delete';

    protected $x;

    protected $y;

    protected $z;

    protected $blockType;

    protected $method;

    public function __construct($x, $y, $z, $blockType, $method)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
        $this->blockType = $blockType;
        $this->method = $method;
    }

    public function getCommandString()
    {
        return sprintf(
            'setblock %d %d %d %s 0 %s',
            $this->x,
            $this->y,
            $this->z,
            $this->blockType,
            $this->method
        );
    }

    public function getResponseParser()
    {
        return null;
    }
}
