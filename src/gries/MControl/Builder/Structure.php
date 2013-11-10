<?php

namespace gries\MControl\Builder;

/**
 * Class Structure
 *
 * Represents a collection of Blocks
 *
 * @package gries\MControl\Builder
 */
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
