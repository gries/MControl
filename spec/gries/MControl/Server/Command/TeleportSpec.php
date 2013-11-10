<?php

namespace spec\gries\MControl\Server\Command;

use PHPSpec\ObjectBehavior;

class TeleportSpec extends ObjectBehavior
{
    function let()
    {
    	$this->beConstructedWith(array());
    }

    function it_should_be_initializable()
    {
    	$this->shouldHaveType('gries\MControl\Server\Command\Teleport');
    }

    function it_throws_exception_if_invalid_number_of_subjects_is_given()
    {
    	$this->beConstructedWith(array('gries'));
    	$this->shouldThrow(new \InvalidArgumentException('Invalid number of teleporting Subjects!'))->during('getCommandString', array());
    }

    function it_works_when_teleporting_two_players()
    {
    	$this->beConstructedWith(array('gries', 'absolem'));
		$this->getCommandString()->shouldReturn('tp gries absolem');
    }

    function it_works_when_teleporting_a_player_to_coordinates()
    {
    	$this->beConstructedWith(array('gries', '~14', '12', '120'));
    	$this->getCommandString()->shouldReturn('tp gries ~14 12 120');
    }
}
