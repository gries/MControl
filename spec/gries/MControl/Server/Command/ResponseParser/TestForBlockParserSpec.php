<?php

namespace spec\gries\MControl\Server\Command\ResponseParser;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TestForBlockParserSpec extends ObjectBehavior
{

    function it_is_initializable()
    {
        $this->shouldImplement('gries\MControl\Server\Command\ResponseParser\ResponseParserInterface');
        $this->shouldHaveType('gries\MControl\Server\Command\ResponseParser\TestForBlockParser');
    }


    function it_returns_true_if_the_block_was_detected()
    {
        $this->getResponse('Successfully found the block at 672,5,-1370.')->shouldReturn(true);
    }

    function it_returns_the_blocks_name_that_was_found_instead()
    {
        $this->getResponse('The block at 672,5,-1370 is tile.air.name (expected: Iron Ore).')
            ->shouldReturn('minecraft:air');
    }

    function it_returns_the_blocks_name_that_was_found_instead_in_no_standard_format()
    {
        $this->getResponse('The block at 672,5,-1370 is Wooden Planks (expected: Iron Ore).')
            ->shouldReturn('Wooden Planks');
    }

    function it_returns_the_blocks_meta_index()
    {
        $this->getResponse('The block at 672,5,-1370 had the data value of 4 (expected: 0).')
            ->shouldReturn('4');
    }
}
