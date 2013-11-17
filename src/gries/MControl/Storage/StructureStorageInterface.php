<?php

namespace gries\MControl\Storage;


use gries\MControl\Builder\Structure;

/**
 * Interface StructureStorageInterface
 *
 * This Interface defines the way structures can be persisted and loaded
 * from a storage.
 *
 * @package gries\MControl\Storage
 */
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