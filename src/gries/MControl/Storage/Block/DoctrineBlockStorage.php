<?php

namespace gries\MControl\Storage\BlockType;

use gries\MControl\Builder\BlockType;
use gries\MControl\Builder\Structure;
use gries\MControl\Storage\DoctrineStorage;

class DoctrineBlockStorage extends DoctrineStorage implements BlockStorageInterface
{
    public function getByStructure(Structure $structure)
    {
        return $this->em
            ->getRepository('gries\MControl\Builder\Block')
            ->findOneBy(array('structure_id' => $structure->getId())
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
}
