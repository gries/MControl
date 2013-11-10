<?php

namespace spec\gries\MControl\Server\Command;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LocatePlayerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
		$this->beConstructedWith(array('gries', '~0', '~0', '~0'));

		$this->shouldBeAnInstanceOf('gries\MControl\Server\Command\LocatePlayer');
		$this->shouldBeAnInstanceOf('gries\MControl\Server\Command\Teleport');
	}

	function it_uses_the_correct_response_parser()
	{
		$this->beConstructedWith(array('gries', '~0', '~0', '~0'));
		$this->getResponseParser()->shouldBeAnInstanceOf('gries\MControl\Server\Command\ResponseParser\LocatePlayerParser');
	}
}
