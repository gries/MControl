<?php

namespace spec\gries\MControl\Storage\Structure;

use Doctrine\ORM\EntityManager;
use PhpSpec\ObjectBehavior;


class DoctrineStructureStorageSpec extends ObjectBehavior
{

    /**
     * @param Doctrine\ORM\EntityManager $entityManager
     */
    function let(EntityManager $entityManager)
    {
        $entityManager->beADoubleOf('Doctrine\ORM\EntityManager');
        $this->beConstructedWith($entityManager);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('gries\MControl\Storage\Structure\DoctrineStructureStorage');
        $this->shouldImplement('gries\MControl\Storage\Structure\StructureStorageInterface');
    }
}
