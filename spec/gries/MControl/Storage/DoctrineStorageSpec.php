<?php

namespace spec\gries\MControl\Storage;

use Doctrine\ORM\EntityManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DoctrineStorageSpec extends ObjectBehavior
{
    /**
     * @param Doctrine\ORM\EntityManager $entityManager
     */
    function it_is_initializable(EntityManager $entityManager)
    {
        $entityManager->beADoubleOf('Doctrine\ORM\EntityManager');
        $this->beConstructedWith($entityManager);
        $this->shouldHaveType('gries\MControl\Storage\DoctrineStorage');
    }
}
