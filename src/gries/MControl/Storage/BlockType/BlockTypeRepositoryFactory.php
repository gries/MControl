<?php
namespace gries\MControl\Storage\BlockType;

use Doctrine\ORM\EntityManager;

class BlockTypeRepositoryFactory
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
        $storage = new DoctrineBlockTypeStorage($entityManager);
        $repository = new BlockTypeRepository($storage);

        return $repository;
    }
}