<?php

namespace spec\gries\MControl\Server;

use gries\MControl\Builder\Block;
use gries\MControl\Builder\Structure;
use gries\MControl\Server\Commander;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StructureBuilderSpec extends ObjectBehavior
{
    /**
     * @param gries\MControl\Server\Commander $commaner
     */
    function it_is_initializable(Commander $commander)
    {
        $this->beConstructedWith($commander);
        $this->shouldHaveType('gries\MControl\Server\StructureBuilder');
    }

    /**
     * @param gries\MControl\Server\Commander $commander
     * @param gries\MControl\Builder\Structure $structure
     * @param gries\MControl\Builder\Block     $block1
     * @param gries\MControl\Builder\Block     $block2
     */
    function it_builds_the_structure_at_the_correct_starting_point(Commander $commander, Structure $structure, Block $block1, Block $block2)
    {
        $this->beConstructedWith($commander);

        // fixtures
        $block1->getCoordinates()->willReturn(array('x' => 1, 'y' => 1, 'z' => 1));
        $block1->getType()->willReturn('iron_block');

        $block2->getCoordinates()->willReturn(array('x' => 1, 'y' => 2, 'z' => 1));
        $block2->getType()->willReturn('diamond_block');

        $structure->getBlocks()->willReturn(array($block1, $block2));

        // mocks
        $commander->setBlock('iron_block', array('x' => 143, 'y' => 55, 'z' => -70))->shouldBeCalled();
        $commander->setBlock('diamond_block', array('x' => 143, 'y' => 56, 'z' => -70))->shouldBeCalled();

        $this->build($structure, array('x' => 142, 'y' => 54, 'z' => -71));
    }
}
