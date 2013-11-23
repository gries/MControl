<?php

namespace spec\gries\MControl\Builder;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BlockTypeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(array());
        $this->shouldHaveType('gries\MControl\Builder\BlockType');
    }

    function it_sets_its_values_via_constructor_arguments()
    {
        $this->beConstructedWith(array(
            'id' => 15,
            'name' => 'minecraft:iron_ore',
            'title' => 'Iron Ore'
        ));

        $this->getId()->shouldBe(15);
        $this->getName()->shouldBe('minecraft:iron_ore');
        $this->getTitle()->shouldBe('Iron Ore');
    }

    function it_updates_its_data_if_new_data_is_passed()
    {
        $this->beConstructedWith(array(
            'id' => 15,
            'name' => 'minecraft:iron_ore',
            'title' => 'Iron Ore'
        ));

        $this->updateData(array(
            'id' => 16,
            'name' => 'minecraft:iron',
            'title' => 'Iron'
        ));

        $this->getId()->shouldBe(16);
        $this->getName()->shouldBe('minecraft:iron');
        $this->getTitle()->shouldBe('Iron');
    }
}
