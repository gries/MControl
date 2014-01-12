<?php

namespace spec\gries\MControl\Server\Command;

use gries\MControl\Builder\BlockType;
use PhpSpec\ObjectBehavior;

class TestForBlockSpec extends ObjectBehavior
{
    /**
     * @param gries\MControl\Builder\BlockType $blockType
     */
    function it_is_initializable(BlockType $blockType)
    {
        $this->beConstructedWith(array(), $blockType);
        $this->shouldHaveType('gries\MControl\Server\Command\TestForBlock');
    }

    /**
     * @param gries\MControl\Builder\BlockType $blockType
     */
    function it_generate_correct_command_string(BlockType $blockType)
    {
        $blockType->getName()->shouldBeCalled()->willReturn('minecraft:iron');

        $this->beConstructedWith(array('x' => 1, 'y' => 1, 'z' => 1), $blockType, 5);

        $this->getCommandString()
            ->shouldReturn('testforblock 1 1 1 minecraft:iron 5')
        ;
    }
}
