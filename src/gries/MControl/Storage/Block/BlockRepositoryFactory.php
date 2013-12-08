<?php
namespace gries\MControl\Storage\Block;

use Doctrine\ORM\EntityManager;
use gries\MControl\Storage\BlockType\DoctrineBlockStorage;

class BlockRepositoryFactory
{
    /**
     * Create a new BlockType repository
     *
     * @param EntityManager $entityManager
     *
     * @return BlockTypeRepository
     */
    public function create(EntityManager $entityManager)
    {
        $storage = new DoctrineBlockStorage($entityManager);
        $repository = new BlockRepository($storage);

        return $repository;
    }
}