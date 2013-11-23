<?php

namespace gries\MControl\Storage\BlockType;


use gries\MControl\Builder\BlockType;

/**
 * Interface BlockTypeStorageInterface
 *
 * This Interface defines the way BlockTypes can be persisted and loaded
 * from a storage.
 *
 * @package gries\MControl\Storage\BlockType
 */
interface BlockTypeStorageInterface
{
    /**
     * Add a BlockType to the storage
     *
     * @param BlockType $blocktype
     *
     * @return void
     */
    public function add(BlockType $blocktype);

    /**
     * Get a BlockType by its name
     *
     * @param $name
     *
     * @return BlockType
     */
    public function getByName($name);

    /**
     * Get a blocktype by its title
     *
     * @param $title
     *
     * @return mixed
     */
    public function getByTitle($title);
}