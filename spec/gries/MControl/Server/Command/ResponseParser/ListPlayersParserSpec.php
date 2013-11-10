<?php

namespace spec\gries\MControl\Server\Command\LogResponseParser;

use PHPSpec\ObjectBehavior;

class ListPlayersParserSpec extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('gries\MControl\Server\Command\LogResponseParser\ListPlayersParser');
    }

    function it_should_parse_player_names_from_log_lines()
    {
        $this->getResponse('There are 2/20 players online:gries, absolem')
            ->shouldReturn(array('gries', 'absolem'));
    }
}
