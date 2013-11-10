<?php

namespace spec\gries\MControl\Builder;

use gries\MControl\Builder\Block;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

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

    public function getMatchers()
    {
        return [
            'haveValue' => function($subject, $value) {
                return in_array($value, $subject);
            },
        ];
    }
}
