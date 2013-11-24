<?php

namespace gries\MControl\Storage\BlockType;

use gries\MControl\Builder\BlockType;
use gries\MControl\Storage\BlockType\BlockTypeStorageInterface;
use gries\MControl\Storage\DoctrineStorage;

class DoctrineBlockTypeStorage extends DoctrineStorage implements BlockTypeStorageInterface
{
    /**
     * Get a BlockType by its name
     *
     * @param $name
     *
     * @return BlockType | null
     */
    public function getByName($name)
    {
        return $this->em
            ->getRepository('gries\MControl\Builder\BlockType')
            ->findOneBy(array('name' => $name)
        );
    }

    /**
     * Add a BlockType to the storage
     *
     * @param BlockType $blockType
     */
    public function add(BlockType $blockType)
    {
        $this->persist($blockType);
    }

    /**
     * Find one blocktype by its title
     *
     * @param $title
     *
     * @return BlockType|null
     */
    public function getByTitle($title)
    {
        return $this->em
            ->getRepository('gries\MControl\Builder\BlockType')
            ->findOneBy(array('title' => $title)
        );
    }

    public function getAll()
    {
        return $this->em
            ->getRepository('gries\MControl\Builder\BlockType')
            ->findAll()
        ;
    }
}
