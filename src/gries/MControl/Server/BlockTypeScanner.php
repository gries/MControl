<?php

namespace gries\MControl\Server;

use gries\MControl\Builder\BlockType;
use gries\MControl\Storage\BlockType\BlockTypeRepository;

class BlockTypeScanner
{
    protected $commander;

    protected $repository;

    protected $cache;

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

        // seach in the cache
        if (isset($this->cache[$detectedType])) {
            return $this->detectMeta($coordinates, $this->cache[$detectedType]);
        }
        // search by name
        if ($type = $this->repository->getByName($detectedType)) {
            $this->cache[$detectedType] = $type;

            return $this->detectMeta($coordinates, $type);
        }

        // search by title
        if ($type = $this->repository->getByTitle($detectedType)) {
            $this->cache[$detectedType] = $type;

            return $this->detectMeta($coordinates, $type);
        }

        // cant find it so bruteforce
        foreach ($this->repository->getAll() as $type) {
            if (true === $this->commander->testForBlock($coordinates, $type)) {
                $this->cache[$detectedType] = $type;

                return $this->detectMeta($coordinates, $type);
            }
        }
    }

    protected function detectMeta($coordinates, BlockType $type)
    {
        $meta = 0;

        $detectedMeta = $this->commander->testForBlock($coordinates, $type, 0);

        if (true !== $detectedMeta && is_numeric($detectedMeta)) {
            $meta = $detectedMeta;
        }

        $type->updateData(array('meta' => $meta));

        return $type;
    }

    protected function getDummyBlockType()
    {
        return $this->repository->getByName('minecraft:air');
    }
}
