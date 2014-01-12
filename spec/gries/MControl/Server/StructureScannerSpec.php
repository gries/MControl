<?php

namespace spec\gries\MControl\Server;

use gries\MControl\Builder\Block;
use gries\MControl\Builder\BlockType;
use gries\MControl\Builder\Structure;
use gries\MControl\Server\BlockTypeScanner;
use PhpSpec\ObjectBehavior;


class StructureScannerSpec extends ObjectBehavior
{
    /**
     * @param gries\MControl\Server\BlockTypeScanner $scanner
     */
    function let(BlockTypeScanner $scanner)
    {
        $this->beConstructedWith($scanner);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('gries\MControl\Server\StructureScanner');
    }

    /**
     * @param gries\MControl\Server\BlockTypeScanner $scanner
     */
    function it_should_scan_a_structure_block_by_block_for_given_coordinates(BlockTypeScanner $scanner)
    {
        $scanner->detectBlockType(array('x' => 6, 'y' => 6, 'z' => 6))->shouldBeCalled()->willReturn(new BlockType(array('name' => 'iron', 'meta' => 0)));
        $scanner->detectBlockType(array('x' => 7, 'y' => 6, 'z' => 6))->shouldBeCalled()->willReturn(new BlockType(array('name' => 'iron', 'meta' => 0)));
        $scanner->detectBlockType(array('x' => 8, 'y' => 6, 'z' => 6))->shouldBeCalled()->willReturn(new BlockType(array('name' => 'iron', 'meta' => 0)));
        $scanner->detectBlockType(array('x' => 6, 'y' => 6, 'z' => 7))->shouldBeCalled()->willReturn(new BlockType(array('name' => 'air', 'meta' => 1)));
        $scanner->detectBlockType(array('x' => 7, 'y' => 6, 'z' => 7))->shouldBeCalled()->willReturn(new BlockType(array('name' => 'iron', 'meta' => 0)));
        $scanner->detectBlockType(array('x' => 8, 'y' => 6, 'z' => 7))->shouldBeCalled()->willReturn(new BlockType(array('name' => 'iron', 'meta' => 0)));

        $expectedStructure = new Structure();
        $expectedStructure->createBlock('iron', array('x' => 1, 'y' => 1, 'z' => 1), 0);
        $expectedStructure->createBlock('iron', array('x' => 2, 'y' => 1, 'z' => 1), 0);
        $expectedStructure->createBlock('iron', array('x' => 3, 'y' => 1, 'z' => 1), 0);
        $expectedStructure->createBlock('air', array('x' => 1, 'y' => 1, 'z' => 2), 1);
        $expectedStructure->createBlock('iron', array('x' => 2, 'y' => 1, 'z' => 2), 0);
        $expectedStructure->createBlock('iron', array('x' => 3, 'y' => 1, 'z' => 2), 0);

        $coordinates = array('x' => 5, 'y' => 5, 'z' => 5);
        $width       = 3;
        $height      = 1;
        $length      = 2;

        $this->scan($coordinates, $width, $length, $height)
            ->shouldBeLike($expectedStructure);
    }
}
