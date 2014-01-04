<?php

namespace gries\MControl\Builder;

class ImageToStructureConverter
{
    /**
     * @var BlockTypeColorMapping
     */
    protected $blockTypeColorMapping;

    /**
     * @param BlockTypeColorMapping $BlockTypeColorMapping
     */
    public function __construct(BlockTypeColorMapping $blockTypeColorMapping)
    {
        $this->blockTypeColorMapping = $blockTypeColorMapping;
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
        $structure     = new Structure();
        $pixelIterator = $image->getPixelIterator();

        for ($y = 1; $y <= $heigh; $y++) {
            $z = 1;
            $x = 1;

            foreach ($pixelIterator as $pixels) {
                $rowZ = $z;

                foreach ($pixels as $pixel) {
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

        $type = $this->blockTypeColorMapping->getBlockTypeForRgbColor($color['r'], $color['g'], $color['b']);

        if (null === $type) {
            return;
        }

        // if meta is null it becomes 0
        $meta = (int)$type->getMeta();

        $structure->createBlock($type->getName(), array('x' => $x, 'y' => $y, 'z' => $z), $meta);
    }
}
