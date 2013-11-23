<?php

namespace gries\MControl\Storage;

use Doctrine\ORM\EntityManager;

class DoctrineStorage
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Add object to the database
     *
     * @param $object
     * @return void
     */
    public function persist($object)
    {
        $this->em->persist($object);
        $this->em->flush();
    }
}
