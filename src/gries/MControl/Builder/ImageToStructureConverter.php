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
    public function convert(\Imagick $image, $heigh = 1)
    {
        $structure = new Structure();
        $pixelIterator  = $image->getPixelIterator();

        for ($y = 1; $y <= $heigh; $y++)
        {
            $z = 1;
            $x = 1;

            foreach ($pixelIterator as $pixels)
            {
                $rowZ = $z;

                foreach ($pixels as $pixel)
                {
                    $this->addBlockForPixel($pixel, $structure, $x, $y, $rowZ);
                    $rowZ++;
                }

                $x++;
                $pixelIterator->syncIterator();
            }
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
