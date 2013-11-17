<?php

namespace spec\gries\MControl\Storage;

use gries\MControl\Builder\Structure;
use gries\MControl\Storage\StructureStorageInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StructureRepositorySpec extends ObjectBehavior
{
    /**
     * @param gries\MControl\Storage\StructureStorageInterface $storage
     */
    function it_is_initializable(StructureStorageInterface $storage)
    {
        $this->beConstructedWith($storage);
        $this->shouldHaveType('gries\MControl\Storage\StructureRepository');
    }


    /**
     * @param gries\MControl\Storage\StructureStorageInterface $storage
     * @param gries\MControl\Builder\Structure
     */
    function it_should_add_a_structure_to_the_storage(StructureStorageInterface $storage, Structure $structure)
    {
        $storage->add($structure)->shouldBeCalled();

        $this->beConstructedWith($storage);

        $this->add($structure);
    }

    /**
     * @param gries\MControl\Storage\StructureStorageInterface $storage
     * @param gries\MControl\Builder\Structure
     */
    function it_should_get_a_structure_by_its_name(StructureStorageInterface $storage, Structure $structure)
    {
        $name = 'somename';
        $storage->getByName($name)
            ->shouldBeCalled()
            ->willReturn($structure)
        ;

        $this->beConstructedWith($storage);

        $this->getByName($name)->shouldReturn($structure);
    }
}
