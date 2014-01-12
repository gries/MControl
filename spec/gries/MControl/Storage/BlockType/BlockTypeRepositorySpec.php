<?php

namespace spec\gries\MControl\Storage\BlockType;

use gries\MControl\Builder\BlockType;
use gries\MControl\Storage\BlockType\BlockTypeStorageInterface;
use PhpSpec\ObjectBehavior;


class BlockTypeRepositorySpec extends ObjectBehavior
{
    /**
     * @param gries\MControl\Storage\BlockType\BlockTypeStorageInterface $storage
     */
    function it_is_initializable($storage)
    {
        $this->beConstructedWith($storage);
        $this->shouldHaveType('gries\MControl\Storage\BlockType\BlockTypeRepository');
    }

    /**
     * @param gries\MControl\Storage\BlockType\BlockTypeStorageInterface $storage
     * @param gries\MControl\Builder\BlockType BlockType
     */
    function it_should_add_a_blocktype_to_the_storage(BlockTypeStorageInterface $storage, BlockType $blocktype)
    {
        $storage->add($blocktype)->shouldBeCalled();

        $this->beConstructedWith($storage);

        $this->add($blocktype);
    }

    /**
     * @param gries\MControl\Storage\BlockType\BlockTypeStorageInterface $storage
     * @param gries\MControl\Builder\BlockType BlockType
     */
    function it_should_get_a_blocktype_by_its_name(BlockTypeStorageInterface $storage, BlockType $blocktype)
    {
        $name = 'somename';
        $storage->getByName($name)
            ->shouldBeCalled()
            ->willReturn($blocktype)
        ;

        $this->beConstructedWith($storage);

        $this->getByName($name)->shouldReturn($blocktype);
    }

    /**
     * @param gries\MControl\Storage\BlockType\BlockTypeStorageInterface $storage
     * @param gries\MControl\Builder\BlockType BlockType
     */
    function it_should_get_a_blocktype_by_its_title(BlockTypeStorageInterface $storage, BlockType $blocktype)
    {
        $name = 'Some Name';
        $storage->getByTitle($name)
            ->shouldBeCalled()
            ->willReturn($blocktype)
        ;

        $this->beConstructedWith($storage);

        $this->getByTitle($name)->shouldReturn($blocktype);
    }

    /**
     * @param gries\MControl\Storage\BlockType\BlockTypeStorageInterface $storage
     */
    function it_should_get_all_blocktypes(BlockTypeStorageInterface $storage)
    {
        $type1 = new BlockType(array());
        $type2 = new BlockType(array());

        $storage->getAll()
            ->shouldBeCalled()
            ->willReturn(array($type1, $type2))
        ;

        $this->beConstructedWith($storage);

        $this->getAll()->shouldReturn(array($type1, $type2));
    }
}
