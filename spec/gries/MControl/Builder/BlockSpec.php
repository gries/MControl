<?php

namespace spec\gries\MControl\Builder;

use PhpSpec\ObjectBehavior;


class BlockSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('iron_block', array('x' => 1, 'y' => -2, 'z' => 3));
        $this->shouldHaveType('gries\MControl\Builder\Block');
    }

    function it_throws_an_exception_if_cooridinates_are_missing()
    {
        $this->beConstructedWith('some_name', array());
        $this
            ->shouldThrow(new \InvalidArgumentException('Missing coordinate: "x" in block.'))
            ->during('__construct', array('some_name', array()))
        ;
    }

    function it_throws_an_exception_if_cooridinates_are_not_numeric()
    {
        $this->beConstructedWith('some_name', array());
        $this
            ->shouldThrow(new \InvalidArgumentException('Coordinate "y" has to be numeric.'))
            ->during('__construct', array('some_name', array('x' => 15, 'y' => 'not on my watch')))
        ;
    }

    function it_returns_a_single_coordinate()
    {
        $this->beConstructedWith('iron_block', array('x' => 1, 'y' => -2, 'z' => 3));

        $this->getCoordinate('x')->shouldReturn(1);
    }
}
