<?php

namespace gries\MControl\Storage;

use Doctrine\ORM\EntityManager;
use gries\MControl\Builder\Structure;

class DoctrineStructureStorage implements StructureStorageInterface
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
     * Add a structure to the storage
     *
     * @param Structure $structure
     *
     * @return void
     */
    public function add(Structure $structure)
    {
        $this->em->persist($structure);
        $this->em->flush();
    }

    /**
     * Get a structure by its name
     *
     * @param $name
     *
     * @return Structure | null
     */
    public function getByName($name)
    {
        return $this->em
            ->getRepository('gries\MControl\Builder\Structure')
            ->findOneBy(array('name' => $name)
        );
    }
}
