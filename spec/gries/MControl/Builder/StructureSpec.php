<?php

namespace spec\gries\MControl\Builder;

use gries\MControl\Builder\Block;
use PhpSpec\ObjectBehavior;


class StructureSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('gries\MControl\Builder\Structure');
    }

    /**
     * @param gries\MControl\Builder\Block $block
     */
    function it_lets_us_add_a_block(Block $block)
    {
        $this->getBlocks()->shouldHaveCount(0);

        $this->addBlock($block);

        $this->getBlocks()->shouldHaveCount(1);
        $this->getBlocks()->shouldHaveValue($block);
    }

    function it_lets_us_add_a_row()
    {
        $this->getBlocks()->shouldHaveCount(0);

        $this->addRow('x', 'iron', 3);

        // expected blocks
        $block1 = new Block('iron', array('x' => 1, 'y' => 1, 'z' => 1));
        $block2 = new Block('iron', array('x' => 2, 'y' => 1, 'z' => 1));
        $block3 = new Block('iron', array('x' => 3, 'y' => 1, 'z' => 1));

        $this->getBlocks()->shouldHaveCount(3);
        $this->getBlocks()->shouldHaveValue($block1);
        $this->getBlocks()->shouldHaveValue($block2);
        $this->getBlocks()->shouldHaveValue($block3);
    }

    function it_lets_us_create_a_block()
    {
        $this->getBlocks()->shouldHaveCount(0);

        $this->createBlock('iron', array('x' => 1, 'y' => 2, 'z' => 3));

        $expectedBlock = new Block('iron', array('x' => 1, 'y' => 2, 'z' => 3));

        $this->getBlocks()->shouldHaveCount(1);
        $this->getBlocks()->shouldHaveValue($expectedBlock);
    }

    public function getMatchers()
    {
        return [
            'haveValue' => function($subject, $value) {
                return in_array($value, $subject);
            },
        ];
    }
}
