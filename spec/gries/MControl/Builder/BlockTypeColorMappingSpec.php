<?php

namespace spec\gries\MControl\Builder;

use gries\MControl\Builder\BlockType;
use PhpSpec\ObjectBehavior;


class BlockTypeColorMappingSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('gries\MControl\Builder\BlockTypeColorMapping');
    }

    function it_maps_to_null_if_nothing_matches()
    {
        $this->beConstructedWith(array(
            '#eeffdd' => new BlockType(['name' => 'foo'])
        ));

        $this->getBlockTypeForHexColor('#ffffff')
            ->shouldReturn(null);
    }

    function it_maps_types_based_on_initial_mapping_given_and_hex_color()
    {
        $expectedBlockType = new BlockType(['name' => 'good']);
        $wrongBlockType    = new BlockType(['name' => 'bad']);

        $this->beConstructedWith(array(
            '#eeffdd' => $expectedBlockType,
            '#ffffff' => $wrongBlockType
        ));

        $this->getBlockTypeForHexColor('#eeffdd')
            ->shouldReturn($expectedBlockType);
    }

    function it_maps_types_based_on_initial_mapping_given_and_rgb_values()
    {
        $expectedBlockType = new BlockType(['name' => 'good']);
        $wrongBlockType    = new BlockType(['name' => 'bad']);

        $this->beConstructedWith(array(
            '#eeffdd' => $expectedBlockType,
            '#ffffff' => $wrongBlockType
        ));

        // this is eeffdd in hex
        $this->getBlockTypeForRgbColor(238, 255, 221)
            ->shouldReturn($expectedBlockType);
    }

    function it_overwrites_initial_mapping_if_manually_set()
    {
        $expectedBlockType = new BlockType(['name' => 'good']);

        $this->beConstructedWith(array(
            '#eeffdd' => new BlockType(['name' => 'bad']),
            '#ffffff' => new BlockType(['name' => 'worse'])
        ));

        $this->map('#eeffdd', $expectedBlockType);

        $this->getBlockTypeForHexColor('#eeffdd')
            ->shouldReturn($expectedBlockType)
        ;
    }
}
