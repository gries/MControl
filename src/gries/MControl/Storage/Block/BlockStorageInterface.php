<?php

namespace gries\MControl\Storage\Block;

use gries\MControl\Builder\Block;
use gries\MControl\Builder\Structure;

/**
 * Interface BlockStorageInterface
 *
 * This Interface defines the way Blocks can be persisted and loaded
 * from a storage.
 *
 * @package gries\MControl\Storage\Block
 */
interface BlockStorageInterface
{
    /**
     * Add a Block to the storage
     *
     * @param Block $blocktype
     *
     * @return void
     */
    public function add(Block $blocktype);

	/**
	 * Get all Blocks linked to a structure
	 *
	 * @param Structure $structure
	 *
	 * @return array containing Blocks
	 */
	public function getByStructure(Structure $structure);
}