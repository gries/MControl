<?php

namespace spec\gries\MControl\Server\Command\ResponseParser;


use PhpSpec\ObjectBehavior;

class LocatePlayerParserSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('somename');
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('gries\MControl\Server\Command\ResponseParser\LocatePlayerParser');
    }

    function it_should_parse_player_names_from_log_lines()
    {
        $this->beConstructedWith('gries');

        $this->getResponse('Teleported gries to 43.25,96.00,195.66')
            ->shouldBeLike(array('x' => '43', 'y' => '96', 'z' => '195'));
    }

    function it_should_be_null_if_a_player_was_not_found()
    {
        $this->beConstructedWith('gries');

        $this->getResponse('Something something that is not an expected response!')
            ->shouldBe(null);
    }
}
