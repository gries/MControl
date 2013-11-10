<?php

namespace spec\gries\MControl\Server\Command;

use gries\MControl\Server\Command\SetBlock;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

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
}
