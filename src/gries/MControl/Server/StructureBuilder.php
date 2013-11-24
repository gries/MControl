<?php

namespace gries\MControl\Server;

use gries\MControl\Builder\Block;
use gries\MControl\Builder\Structure;

class StructureBuilder
{
    /**
     * @var Commander
     */
    protected $commander;

    /**
     * @param Commander $commander
     */
    public function __construct(Commander $commander)
    {
        $this->commander = $commander;
    }

    public function build(Structure $structure, array $startingCoordinates)
    {
        foreach ($structure->getBlocks() as $block) {
            $this->buildBlock($block, $startingCoordinates);
        }
    }

    protected function buildBlock(Block $block, array $startingCoordinates)
    {
        $relativeCoordinates = $block->getCoordinates();

        // sum the coordinates
        $blockCoordinates = [
            'x' => $relativeCoordinates['x'] + $startingCoordinates['x'],
            'y' => $relativeCoordinates['y'] + $startingCoordinates['y'],
            'z' => $relativeCoordinates['z'] + $startingCoordinates['z'],
        ];

        $this->commander->setBlock($block->getType(), $blockCoordinates, $block->getMeta());
    }
}
