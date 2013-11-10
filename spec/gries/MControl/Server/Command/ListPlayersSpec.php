<?php

namespace spec\gries\MControl\Server\Command;

use PHPSpec\ObjectBehavior;

class ListPlayersSpec extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('gries\MControl\Server\Command\ListPlayers');
    }

    function it_creates_correct_command_string()
    {
        $this->getCommandString()->shouldReturn('list');
    }
}
