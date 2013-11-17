<?php

namespace gries\Storage;


use gries\MControl\Builder\Structure;

interface StructureStorageInterface
{
    /**
     * Add a structure to the storage
     *
     * @param Structure $structure
     *
     * @return void
     */
    public function add(Structure $structure);

    /**
     * Get a structure by its name
     *
     * @param $name
     *
     * @return Structure
     */
    public function getByName($name);
}