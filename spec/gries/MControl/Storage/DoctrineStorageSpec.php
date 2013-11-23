<?php

namespace spec\gries\MControl\Storage;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DoctrineStorageSpec extends ObjectBehavior
{
    function it_is_initializable($entityManager)
    {
        $entityManager->beADoubleOf('Doctrine\ORM\EntityManager');
        $this->beConstructedWith($entityManager);
        $this->shouldHaveType('gries\MControl\Storage\DoctrineStorage');
    }
}
