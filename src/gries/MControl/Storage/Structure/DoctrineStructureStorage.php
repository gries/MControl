<?php

namespace gries\MControl\Storage\Structure;

use gries\MControl\Builder\Structure;
use gries\MControl\Storage\DoctrineStorage;

class DoctrineStructureStorage extends DoctrineStorage implements StructureStorageInterface
{
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

    /**
     * Add a structure to the storage
     *
     * @param Structure $structure
     */
    public function add(Structure $structure)
    {
        $this->persist($structure);
    }
}
