<?php

namespace gries\MControl\Server;

use gries\MControl\Storage\BlockType\BlockTypeRepository;

class BlockTypeScanner
{
    protected $commander;

    protected $repository;

    public function __construct(Commander $commander, BlockTypeRepository $repository)
    {
        $this->commander  = $commander;
        $this->repository = $repository;
    }

    public function detectBlockType(array $coordinates)
    {
        $dummyType = $this->getDummyBlockType();

        $detectedType = $this->commander->testForBlock($coordinates, $dummyType);

        if (true === $detectedType) {
            return $dummyType;
        }

        // search by name
        if ($type = $this->repository->getByName($detectedType)) {
            return $type;
        }

        // search by title
        if ($type = $this->repository->getByTitle($detectedType)) {
            return $type;
        }

        // cant find it so bruteforce
        foreach ($this->repository->getAll() as $type) {

            if (true === $this->commander->testForBlock($coordinates, $type)) {
                return $type;
            }
        }
    }

    protected function getDummyBlockType()
    {
        return $this->repository->getByName('minecraft:air');
    }
}
