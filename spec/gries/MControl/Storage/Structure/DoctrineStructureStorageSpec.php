<?php

namespace spec\gries\MControl\Storage\Structure;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DoctrineStructureStorageSpec extends ObjectBehavior
{
    function let($entityManager)
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
