<?php

namespace gries\MControl\Builder;


/**
 * Class Block
 *
 * A single block
 *
 * @package gries\MControl\Builder
 */
class Block
{
    protected $type;

    protected $coordinates;

    /**
     * @param array $coordinates
     */
    public function setCoordinates($coordinates)
    {
        $this->coordinates = $coordinates;
    }

    /**
     * @return array
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    public function __construct($type, array $coordinates)
    {
        $this->validateCoordinate('x', $coordinates);
        $this->validateCoordinate('y', $coordinates);
        $this->validateCoordinate('z', $coordinates);

        $this->type = $type;
        $this->coordinates = $coordinates;
    }

    /**
     * Check if a coordinate is present and numeric
     *
     * @param $coordinate
     * @param $coordinates
     *
     * @throws \InvalidArgumentException
     */
    protected function validateCoordinate($coordinate, $coordinates)
    {
        if (!isset($coordinates[$coordinate]))
        {
            throw new \InvalidArgumentException(sprintf('Missing coordinate: "%s" in block.', $coordinate));
        }

        if (!is_numeric($coordinates[$coordinate]))
        {
            throw new \InvalidArgumentException(sprintf('Coordinate "%s" has to be numeric.', $coordinate));
        }
    }

    public function getCoordinate($coordinate)
    {
        return $this->coordinates[$coordinate];
    }
}
