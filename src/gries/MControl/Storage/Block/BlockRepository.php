<?php

namespace gries\MControl\Storage\Block;

use gries\MControl\Builder\Block;
use gries\MControl\Builder\Structure;

class BlockRepository
{
	/**
	 * @var BlockStorageInterface
	 */
	protected $storage;

    public function __construct(BlockStorageInterface $storage)
    {
        $this->storage = $storage;
    }

	/**
	 * Add a block to the repository
	 *
	 * @param Block $block
	 */
	public function add(Block $block)
    {
        $this->storage->add($block);
    }

	/**
	 * Get all Blocks for a given Structure
	 *
	 * @param Structure $structure
	 *
	 * @return array
	 */
	public function getByStructure(Structure $structure)
    {
        return $this->storage->getByStructure($structure);
    }
}
