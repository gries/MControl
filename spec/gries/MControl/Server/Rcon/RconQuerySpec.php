<?php

namespace spec\gries\MControl\Server\Rcon;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RconQuerySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldBeAnInstanceOf('gries\MControl\Server\Rcon\RconQuery');
        $this->shouldBeAnInstanceOf('\SourceQuery');
    }

//    function it_should_tell_us_about_its_connect_state()
//    {
//        $this->setConnected(true);
//
//        $this->isConnected()->shouldBe(true);
//    }
}
