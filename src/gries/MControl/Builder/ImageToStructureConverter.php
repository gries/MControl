<?php

namespace gries\MControl\Builder;

class ImageToStructureConverter
{
    protected $whiteBlockType;

    protected $blackBlockType;


    public function setWhiteBlockType($type)
    {
        $this->whiteBlockType = $type;
    }

    public function setBlackBlockType($type)
    {
        $this->blackBlockType = $type;
    }

    /**
     * Convert the image to a minecraft structure.
     *
     * @param \Imagick $image
     *
     * @return Structure
     */
    public function convert(\Imagick $image)
    {
        $structure = new Structure();
        $iterator  = $image->getPixelIterator();

        $z = 1;
        $x = 1;
        $y = 1;

        foreach ($iterator as $row => $pixels)
        {
            $rowZ = $z;

            foreach ($pixels as $column => $pixel)
            {
                $this->addBlockForPixel($pixel, $structure, $x, $y, $rowZ);
                $rowZ++;
            }

            $x++;
            $iterator->syncIterator();
        }

        return $structure;
    }

    /**
     * Add a Block to a pixel to a given coordinate depending
     * on a pixels color
     *
     * @param \ImagickPixel $pixel
     * @param Structure     $structure
     * @param               $x
     * @param               $y
     * @param               $z
     */
    protected function addBlockForPixel(\ImagickPixel $pixel, Structure $structure, $x, $y, $z)
    {
        $color = $pixel->getColor();
        if ($color['r'] < 200 && $color['g'] < 200 && $color['b'] < 200)
        {
            $structure->createBlock($this->blackBlockType, array('x' => $x, 'y' => $y, 'z' => $z));
        }
        else
        {
            $structure->createBlock($this->whiteBlockType, array('x' => $x, 'y' => $y, 'z' => $z));
        }
    }
}
