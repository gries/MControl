<?php

namespace spec\gries\MControl\Server\Command;

use gries\MControl\Server\Command\SetBlock;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SetBlockSpec extends ObjectBehavior
{
	public function let()
	{
		$this->beConstructedWith(215, 80, 251, 'minecraft:iron_ore', SetBlock::$SET_METHOD_KEEP);
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
