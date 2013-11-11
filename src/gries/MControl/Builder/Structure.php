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

    public function addRow($axis, $type, $length, $startingPosition = array('x' => 1, 'y' => 1, 'z' => 1))
    {
        for ($i = 0; $i < $length; $i++)
        {
            $newPosition = $startingPosition;
            $newPosition[$axis] += $i;
            $block = new Block($type, $newPosition);
            $this->addBlock($block);
        }
    }
}
