<?php
namespace gries\MControl\Storage\Structure;

use Doctrine\ORM\EntityManager;

class StructureRepositoryFactory
{
    /**
     * Create a new structure repository
     *
     * @param EntityManager $entityManager
     *
     * @return StructureRepository
     */
    public function create(EntityManager $entityManager)
    {
        $storage = new DoctrineStructureStorage($entityManager);
        $repository = new StructureRepository($storage);

        return $repository;
    }
}