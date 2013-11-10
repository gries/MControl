<?php

namespace spec\gries\MControl\Server\Command;

use PhpSpec\ObjectBehavior;

class GiveSpecSpec extends ObjectBehavior
{
	function let()
	{
		$this->beConstructedWith('gries', 25, 60);
	}

    function it_should_be_initializable()
    {
        $this->shouldHaveType('gries\MControl\Server\Command\Give');
    }

	function it_creates_correct_command_string()
	{
		$this->beConstructedWith('gries', 14, 32);
		$this->getCommandString()->shouldReturn('give gries 14 32');
	}
}
