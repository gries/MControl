<?php

namespace spec\gries\MControl\Server\Command;

use gries\MControl\Server\Command\SetBlock;
use PhpSpec\ObjectBehavior;


class SetBlockSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('minecraft:iron_ore', array('x' => 215, 'y' => 80, 'z' => 251), SetBlock::SET_METHOD_KEEP);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('gries\MControl\Server\Command\SetBlock');
    }

    function it_creates_correct_command_string()
    {
        $this->getCommandString()
            ->shouldBeLike('setblock 215 80 251 minecraft:iron_ore 0 keep')
        ;
    }

    function it_creates_uses_meta_index_in_command_string()
    {
        $this->beConstructedWith('minecraft:iron_ore', array('x' => 215, 'y' => 80, 'z' => 251), SetBlock::SET_METHOD_KEEP, 5);

        $this->getCommandString()
            ->shouldBeLike('setblock 215 80 251 minecraft:iron_ore 5 keep')
        ;
    }
}
