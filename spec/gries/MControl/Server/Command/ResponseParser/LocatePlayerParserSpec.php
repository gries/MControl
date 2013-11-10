<?php

namespace spec\gries\MControl\Server\Command\LogResponseParser;

use PHPSpec\ObjectBehavior;

class LocatePlayerParserSpec extends ObjectBehavior
{
	function let()
	{
		$this->beConstructedWith('somename');
	}

    function it_should_be_initializable()
    {
        $this->shouldHaveType('gries\MControl\Server\Command\LogResponseParser\LocatePlayerParser');
    }

    function it_should_parse_player_names_from_log_lines()
    {
    	$this->beConstructedWith('gries');

    	$this->getResponse('Teleported gries to 43.25,96.00,195.66')
			->shouldBeLike(array('x' => '43','y' => '96','z' => '195'));
    }
}
