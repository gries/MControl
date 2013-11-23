<?php

namespace gries\MControl\Storage\BlockType;

use gries\MControl\Builder\BlockType;

class BlockTypeRepository
{
    /**
     * @var BlockTypeStorageInterface
     */
    protected $storage;

    public function __construct(BlockTypeStorageInterface $storage)
    {
        $this->storage = $storage;
    }

    public function add(BlockType $blocktype)
    {
        $this->storage->add($blocktype);
    }

    public function getByName($name)
    {
        return $this->storage->getByName($name);
    }

    public function getByTitle($title)
    {
        return $this->storage->getByTitle($title);

    }
}
