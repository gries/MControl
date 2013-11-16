<?php

namespace spec\gries\MControl\Builder;

use gries\MControl\Builder\Structure;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ImageToStructureConverterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('gries\MControl\Builder\ImageToStructureConverter');
    }

    function it_should_create_a_structure_based_on_a_Imagick_object()
    {
        $expectedStructure = new Structure();
        $expectedStructure->createBlock('iron_block', array('x' =>1, 'y' => 1, 'z' => 1));
        $expectedStructure->createBlock('iron_block', array('x' =>1, 'y' => 1, 'z' => 2));

        $expectedStructure->createBlock('coal_block', array('x' =>2, 'y' => 1, 'z' => 1));
        $expectedStructure->createBlock('coal_block', array('x' =>2, 'y' => 1, 'z' => 2));

        // returns a 2x2 image with 2 black and 2 white pixels
        $image = $this->getImage();

        $this->setWhiteBlockType('iron_block');
        $this->setBlackBlockType('coal_block');

        $this->convert($image)
            ->shouldBeLike($expectedStructure)
        ;
    }

    protected function getImage()
    {
        $image = new \Imagick();
        $image->newImage(2,2, new \ImagickPixel('white'));

        $draw = new \ImagickDraw();
        $draw->setFillColor(new \ImagickPixel('black'));
        $draw->color(0, 1, \Imagick::PAINT_POINT );

        $draw2 = new \ImagickDraw();
        $draw2->setFillColor(new \ImagickPixel('black'));
        $draw2->color(1, 1, \Imagick::PAINT_POINT );

        $image->drawImage($draw);
        $image->drawimage($draw2);

        $image->setformat('png');
        $image->writeimage('test.png');



        return $image;
    }
}
