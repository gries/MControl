<?php

namespace spec\gries\MControl\Builder;

use PhpSpec\ObjectBehavior;


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
            'title' => 'Iron Ore',
            'meta'  => 0
        ));

        $this->getId()->shouldBe(15);
        $this->getName()->shouldBe('minecraft:iron_ore');
        $this->getTitle()->shouldBe('Iron Ore');
        $this->getMeta()->shouldBe(0);
    }

    function it_updates_its_data_if_new_data_is_passed()
    {
        $this->beConstructedWith(array(
            'id' => 15,
            'name' => 'minecraft:iron_ore',
            'title' => 'Iron Ore',
            'meta' => 0
        ));

        $this->updateData(array(
            'id' => 16,
            'name' => 'minecraft:iron',
            'title' => 'Iron',
            'meta' => 1
        ));

        $this->getId()->shouldBe(16);
        $this->getName()->shouldBe('minecraft:iron');
        $this->getTitle()->shouldBe('Iron');
        $this->getMeta()->shouldBe(1);
    }

    function it_sets_its_color_values()
    {
        $this->beConstructedWith(array(
            'id' => 15,
            'name' => 'minecraft:iron_ore',
            'title' => 'Iron Ore',
            'meta'  => 0,
            'color' => ['3c', '3d', '3e']
        ));

        $this->color()->shouldBe('3c3d3e');
    }
}
