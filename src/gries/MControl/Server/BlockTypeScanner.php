<?php

namespace gries\MControl\Server;

use gries\MControl\Builder\BlockType;
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
            return $this->detectMeta($coordinates, $dummyType);
        }

        // search by name
        if ($type = $this->repository->getByName($detectedType)) {
            return $this->detectMeta($coordinates, $type);
        }

        // search by title
        if ($type = $this->repository->getByTitle($detectedType)) {
            return $this->detectMeta($coordinates, $type);
        }

        // cant find it so bruteforce
        foreach ($this->repository->getAll() as $type) {

            if (true === $this->commander->testForBlock($coordinates, $type)) {
                return $this->detectMeta($coordinates, $type);
            }
        }
    }

    protected function detectMeta($coordinates, BlockType $type)
    {
        if (true === $meta = $this->commander->testForBlock($coordinates, $type, 0)) {
            $type->updateData(array('meta' => 0));
        }
        else {
            $type->updateData(array('meta' => $meta));
        }

        return $type;
    }

    protected function getDummyBlockType()
    {
        return $this->repository->getByName('minecraft:air');
    }
}
