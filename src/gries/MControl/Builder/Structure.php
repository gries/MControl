<?php

namespace gries\MControl\Builder;

class Structure
{
    protected $blocks = [];

    public function getBlocks()
    {
        return $this->blocks;
    }

    public function addBlock(Block $block)
    {
        $this->blocks[] = $block;
    }
}
