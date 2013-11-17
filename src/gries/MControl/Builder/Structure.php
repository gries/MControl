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

    protected $name;


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

    public function createBlock($type, array $coordinates)
    {
        $block = new Block($type, $coordinates);
        $this->addBlock($block);
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}
