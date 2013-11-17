<?php
namespace gries\MControl\Storage;


use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class StructureRepositoryFactory
{
    public function create(EntityManager $entityManager)
    {
        $storage = new DoctrineStructureStorage($entityManager);
        $repository = new StructureRepository($storage);

        return $repository;
    }
}