<?php

namespace gries\MControl\Server;

use gries\MControl\Builder\Structure;

class StructureScanner
{
    protected $scanner;

    public function __construct(BlockTypeScanner $scanner)
    {
        $this->scanner = $scanner;
    }

    public function scan(array $coordinates, $width, $length, $height)
    {
        $structure = new Structure();
        // go through the height
        for ($y = 1; $y <= $height; $y++)
        {
            // go through the length
            for ($z = 1; $z <= $length; $z++)
            {
                // go through the width
                for ($x = 1; $x <= $width; $x++)
                {
                    $currentX = $coordinates['x'] + $x;
                    $currentY = $coordinates['y'] + $y;
                    $currentZ = $coordinates['z'] + $z;
                    $currentCoordinates = array(
                        'x' => $currentX,
                        'y' => $currentY,
                        'z' => $currentZ
                    );

                    $type = $this->scanner->detectBlockType($currentCoordinates);

                    $structure->createBlock($type->getName(), array(
                        'x' => $x,
                        'y' => $y,
                        'z' => $z
                    ));
                }
            }
        }

        return $structure;
    }
}
