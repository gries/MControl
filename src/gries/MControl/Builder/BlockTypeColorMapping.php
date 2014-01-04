<?php

namespace gries\MControl\Builder;

class BlockTypeColorMapping
{
    protected $mapping;

    public function __construct(array $mapping = array())
    {
        $this->mapping = $mapping;
    }

    /**
     * Map a BlockType to a color-value
     * Color values must be hex: #aaddee
     *
     * @param           $color
     * @param BlockType $type
     */
    public function map($color, BlockType $type)
    {
        $this->mapping[$color] = $type;
    }

    /**
     * Get a BlockType according to the mapping based on a given rgb-color
     *
     * @param $red
     * @param $green
     * @param $blue
     *
     * @return BlockType
     */
    public function getBlockTypeForRgbColor($red, $green, $blue)
    {
        $hex = $this->rgbToHex($red, $green, $blue);

        return $this->getBlockTypeForHexColor($hex);
    }

    /**
     * Get the blockType according to the mapping based on a given hex-color string
     *
     * @param $hexColor
     *
     * @return BlockType
     */
    public function getBlockTypeForHexColor($hexColor)
    {
        if (isset($this->mapping[$hexColor])) {
            return $this->mapping[$hexColor];
        }

        return null;
    }

    /**
     * Convert rgb values to a html hex representation.
     *
     * 238, 255, 221 => #eeffdd
     *
     * @param $r
     * @param $g
     * @param $b
     *
     * @return string
     */
    protected function rgbToHex($r, $g, $b)
    {
        $hex = "#";
        $hex.= str_pad(dechex($r), 2, "0", STR_PAD_LEFT);
        $hex.= str_pad(dechex($g), 2, "0", STR_PAD_LEFT);
        $hex.= str_pad(dechex($b), 2, "0", STR_PAD_LEFT);

        return $hex;
    }
}
