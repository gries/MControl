<?php

namespace spec\gries\MControl\Server\Command;

use PHPSpec\ObjectBehavior;

class WeatherSpec extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('gries\MControl\Server\Command\Weather');
    }

    function let()
    {
    	$this->beConstructedWith('clear', 900);
    }

    function it_throws_exception_if_invalid_weather_type_given()
    {
    	$exception = new \InvalidArgumentException('Invalid weather-type given!');

    	$this->shouldThrow($exception)->during('__construct', array('Deathly Hurricane WEATHER'));
    }

    function it_uses_900_seconds_as_default_value()
    {
    	$this->beConstructedWith('thunder');
    	$this->getCommandString()->shouldReturn('weather thunder 900');
    }

    function it_uses_given_seconds_if_provided()
    {
    	$this->beConstructedWith('clear', 35);
    	$this->getCommandString()->shouldReturn('weather clear 35');
    }
}