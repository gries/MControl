<?php

namespace spec\gries\MControl\Server;

use gries\MControl\Builder\BlockType;
use gries\MControl\Server\Commander;
use gries\MControl\Storage\BlockType\BlockTypeRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BlockTypeScannerSpec extends ObjectBehavior
{
    /**
     * @param gries\MControl\Storage\BlockType\BlockTypeRepository $repo
     * @param gries\MControl\Server\Commander                      $commander
     */
    function let(Commander $commander, BlockTypeRepository $repo)
    {
        $this->beConstructedWith($commander, $repo);
    }

    function it_is_initializable(Commander $commander)
    {
        $this->shouldHaveType('gries\MControl\Server\BlockTypeScanner');
    }

    /**
     * @param gries\MControl\Server\Commander                      $commander
     * @param gries\MControl\Storage\BlockType\BlockTypeRepository $repo
     */
    function it_detects_a_blocktype(Commander $commander, BlockTypeRepository $repo)
    {
        $dummyBlockType = new BlockType(array('name' => 'air'));

        $coordinates = array('x' => 1, 'y' => 1, 'z' => 1);

        $commander
            ->testForBlock($coordinates, $dummyBlockType)
            ->shouldBeCalled()
            ->willReturn(true);

        $repo->getByName('minecraft:air')
            ->shouldBeCalled()
            ->willReturn($dummyBlockType);

        $this
            ->detectBlockType($coordinates)
            ->shouldReturn($dummyBlockType);
    }

    /**
     * @param gries\MControl\Server\Commander                      $commander
     * @param gries\MControl\Storage\BlockType\BlockTypeRepository $repo
     */
    function it_searches_the_repo_if_type_is_not_detected(Commander $commander, BlockTypeRepository $repo)
    {
        $dummyBlockType = new BlockType(array('name' => 'air'));
        $dirtType       = new BlockType(array('name' => 'dirt'));

        $coordinates = array('x' => 1, 'y' => 1, 'z' => 1);

        $commander
            ->testForBlock($coordinates, $dummyBlockType)
            ->shouldBeCalled()
            ->willReturn('minecraft:dirt');

        $repo->getByName('minecraft:air')
            ->shouldBeCalled()
            ->willReturn($dummyBlockType);

        $repo->getByName('minecraft:dirt')
            ->shouldBeCalled()
            ->willReturn($dirtType);

        $this
            ->detectBlockType($coordinates)
            ->shouldReturn($dirtType);
    }

    /**
     * @param gries\MControl\Server\Commander                      $commander
     * @param gries\MControl\Storage\BlockType\BlockTypeRepository $repo
     */
    function it_searches_the_repo_by_title_if_type_is_not_detected(Commander $commander, BlockTypeRepository $repo)
    {
        $dummyBlockType = new BlockType(array('name' => 'air'));
        $plankType      = new BlockType(array('name' => 'minecraft:planks', 'title' => 'Planks'));

        $coordinates = array('x' => 1, 'y' => 1, 'z' => 1);

        $commander
            ->testForBlock($coordinates, $dummyBlockType)
            ->shouldBeCalled()
            ->willReturn('Planks');

        $repo->getByName('minecraft:air')
            ->shouldBeCalled()
            ->willReturn($dummyBlockType);

        $repo->getByName('Planks')
            ->shouldBeCalled()
            ->willReturn(null);

        $repo->getByTitle('Planks')
            ->shouldBeCalled()
            ->willReturn($plankType);

        $this
            ->detectBlockType($coordinates)
            ->shouldReturn($plankType);
    }

    /**
     * @param gries\MControl\Server\Commander                      $commander
     * @param gries\MControl\Storage\BlockType\BlockTypeRepository $repo
     */
    function it_bruteforces_the_type_is_not_detected(Commander $commander, BlockTypeRepository $repo)
    {
        $dummyBlockType = new BlockType(array('name' => 'air'));
        $plankType      = new BlockType(array('name' => 'minecraft:planks', 'title' => 'Wooden Planks'));

        $airBlockType  = $dummyBlockType;
        $ironBlockType = new BlockType(array('name' => 'minecraft:iron_ore'));

        $coordinates = array('x' => 1, 'y' => 1, 'z' => 1);

        $commander
            ->testForBlock($coordinates, $dummyBlockType)
            ->shouldBeCalled()
            ->willReturn('Wooden Planks');

        $repo->getByName('minecraft:air')
            ->shouldBeCalled()
            ->willReturn($dummyBlockType);

        $repo->getByName('Wooden Planks')
            ->shouldBeCalled()
            ->willReturn(null);

        $repo->getByTitle('Wooden Planks')
            ->shouldBeCalled()
            ->willReturn(null);

        $repo->getAll()
            ->shouldBeCalled()
            ->willReturn(array(
                    $airBlockType,
                    $ironBlockType,
                    $plankType
                )
            );

        $commander
            ->testForBlock($coordinates, $airBlockType)
            ->shouldBeCalled()
            ->willReturn('Wooden Planks');

        $commander
            ->testForBlock($coordinates, $ironBlockType)
            ->shouldBeCalled()
            ->willReturn('Wooden Planks');

        $commander
            ->testForBlock($coordinates, $plankType)
            ->shouldBeCalled()
            ->willReturn(true);

        $this
            ->detectBlockType($coordinates)
            ->shouldReturn($plankType)
        ;
    }
}
