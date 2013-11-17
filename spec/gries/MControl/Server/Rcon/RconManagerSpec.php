<?php

namespace spec\gries\MControl\Server\Rcon;

use gries\MControl\Server\Command\Say;
use gries\MControl\Server\Rcon\RconQuery;
use PhpSpec\ObjectBehavior;


/** @noinspection PhpUndefinedClassInspection */
class RconManagerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('localhost', 25575, 'p4ssw0rd');
        $this->shouldHaveType('gries\MControl\Server\Rcon\RconManager');
    }


    /**
     * @param gries\MControl\Server\Command\Say     $command
     * @param gries\MControl\Server\Rcon\RconQuery  $rcon
     */
    function it_should_execute_a_command_via_rcon(Say $command, RconQuery $rcon)
    {
        $this->beConstructedWith('localhost', 25575, 'p4ssw0rd');

        $command->getCommandString()->willReturn('say hi');
        $command->getResponseParser()->willReturn(null);

        $rcon->SetRconPassword('p4ssw0rd')->shouldBeCalled();
        $rcon->Rcon('say hi')->shouldBeCalled();

        $this->setRcon($rcon);

        $this->execute($command);
    }
}
