<?php

namespace gries\MControl\Storage;

use gries\MControl\Builder\Structure;

class StructureRepository
{
    /**
     * @var StructureStorageInterface
     */
    protected $storage;

    public function __construct(StructureStorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * Add a structure to the storage
     *
     * @param Structure $structure
     */
    public function add(Structure $structure)
    {
        $this->storage->add($structure);
    }

    /**
     * Get a structure by its name
     *
     * @param $name
     *
     * @return \gries\MControl\Builder\Structure
     */
    public function getByName($name)
    {
        return $this->storage->getByName($name);
    }
}
