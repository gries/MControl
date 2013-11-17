<?php
namespace gries\MControl\Storage;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

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