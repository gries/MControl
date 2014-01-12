<?php

namespace spec\gries\MControl\Server\Command;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RawSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('my custom command 1 2 3');

        $this->shouldHaveType('gries\MControl\Server\Command\Raw');
        $this->shouldImplement('gries\\MControl\\Server\\Command\\CommandInterfacee');
    }

    function it_creates_correct_command_string()
    {
        $this->beConstructedWith('my custom command 1 2 3');

        $this->getCommandString()->shouldBe('my custom command 1 2 3');
    }
}
