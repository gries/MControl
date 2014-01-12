<?php

namespace spec\gries\MControl\Builder;

use gries\MControl\Builder\BlockType;
use gries\MControl\Builder\BlockTypeColorMapping;
use gries\MControl\Builder\Structure;
use PhpSpec\ObjectBehavior;


class ImageToStructureConverterSpec extends ObjectBehavior
{
    /**
     * @param gries\MControl\Builder\BlockTypeColorMapping $blockTypeColorMapping
     */
    function it_is_initializable($blockTypeColorMapping)
    {
        $this->beConstructedWith($blockTypeColorMapping);
        $this->shouldHaveType('gries\MControl\Builder\ImageToStructureConverter');
    }


    /**
     * @param gries\MControl\Builder\BlockTypeColorMapping $blockTypeColorMapping
     */
    function it_should_create_a_structure_based_on_a_Imagick_object(BlockTypeColorMapping $blockTypeColorMapping)
    {
        $blackBlockType = new BlockType(array('name' => 'coal_block'));
        $blockTypeColorMapping
            ->getBlockTypeForRgbColor(255, 255, 255)
            ->willReturn($blackBlockType)
        ;

        $whiteBlockType = new BlockType(array('name' => 'iron_block'));
        $blockTypeColorMapping
            ->getBlockTypeForRgbColor(0, 0, 0)
            ->willReturn($whiteBlockType)
        ;

        $this->beConstructedWith($blockTypeColorMapping);

        $expectedStructure = new Structure();
        $expectedStructure->createBlock('coal_block', array('x' => 1, 'y' => 1, 'z' => 1));
        $expectedStructure->createBlock('coal_block', array('x' => 1, 'y' => 1, 'z' => 2));

        $expectedStructure->createBlock('iron_block', array('x' => 2, 'y' => 1, 'z' => 1));
        $expectedStructure->createBlock('iron_block', array('x' => 2, 'y' => 1, 'z' => 2));

        // returns a 2x2 image with 2 black and 2 white pixels
        $image = $this->getImage();

        $this->convert($image)
            ->shouldBeLike($expectedStructure);

    }

    /**
     * @param gries\MControl\Builder\BlockTypeColorMapping $blockTypeColorMapping
     */
    function it_creates_multiple_levels_of_the_image_depending_on_the_given_heigh(BlockTypeColorMapping $blockTypeColorMapping)
    {
        $blackBlockType = new BlockType(array('name' => 'coal_block'));
        $blockTypeColorMapping
            ->getBlockTypeForRgbColor(255, 255, 255)
            ->willReturn($blackBlockType)
        ;

        $whiteBlockType = new BlockType(array('name' => 'iron_block', 'meta' => 2));
        $blockTypeColorMapping
            ->getBlockTypeForRgbColor(0, 0, 0)
            ->willReturn($whiteBlockType)
        ;

        $this->beConstructedWith($blockTypeColorMapping);

        $expectedStructure = new Structure();
        $expectedStructure->createBlock('coal_block', array('x' => 1, 'y' => 1, 'z' => 1));
        $expectedStructure->createBlock('coal_block', array('x' => 1, 'y' => 1, 'z' => 2));
        $expectedStructure->createBlock('iron_block', array('x' => 2, 'y' => 1, 'z' => 1), 2);
        $expectedStructure->createBlock('iron_block', array('x' => 2, 'y' => 1, 'z' => 2), 2);
        $expectedStructure->createBlock('coal_block', array('x' => 1, 'y' => 2, 'z' => 1));
        $expectedStructure->createBlock('coal_block', array('x' => 1, 'y' => 2, 'z' => 2));
        $expectedStructure->createBlock('iron_block', array('x' => 2, 'y' => 2, 'z' => 1), 2);
        $expectedStructure->createBlock('iron_block', array('x' => 2, 'y' => 2, 'z' => 2), 2);
        // returns a 2x2 image with 2 black and 2 white pixels
        $image = $this->getImage();

        $this->convert($image, 2)
            ->shouldBeLike($expectedStructure);
    }

    protected function getImage()
    {
        $image = new \Imagick();
        $image->newImage(2, 2, new \ImagickPixel('white'));

        $draw = new \ImagickDraw();
        $draw->setFillColor(new \ImagickPixel('black'));
        $draw->color(0, 1, \Imagick::PAINT_POINT);

        $draw2 = new \ImagickDraw();
        $draw2->setFillColor(new \ImagickPixel('black'));
        $draw2->color(1, 1, \Imagick::PAINT_POINT);

        $image->drawImage($draw);
        $image->drawimage($draw2);

        $image->setformat('png');

        return $image;
    }
}
