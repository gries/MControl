<?php

namespace spec\gries\MControl\Storage\Block;

use gries\MControl\Builder\Block;
use gries\MControl\Builder\Structure;
use gries\MControl\Storage\Block\BlockStorageInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BlockRepositorySpec extends ObjectBehavior
{
	/**
	 * @param gries\MControl\Storage\Block\BlockStorageInterface $storage
	 */
	function it_is_initializable($storage)
	{
		$this->beConstructedWith($storage);
		$this->shouldImplement('gries\MControl\Storage\Block\BlockRepository');
	}

	/**
	 * @param gries\MControl\Storage\Block\BlockStorageInterface $storage
	 * @param gries\MControl\Builder\Block $block
	 */
	function it_should_add_a_block_to_the_storage(BlockStorageInterface $storage, Block $block)
	{
		$storage->add($block)->shouldBeCalled();

		$this->beConstructedWith($storage);

		$this->add($block);
	}

	/**
	 * @param gries\MControl\Storage\Block\BlockStorageInterface $storage
	 * @param gries\MControl\Builder\Structure $structure
	 * @param gries\MControl\Builder\Block $block
	 */
	function it_should_get_all_blocks_for_a_structure(BlockStorageInterface $storage, Structure $structure, Block $block)
	{
		$storage->getByStructure($structure)
			->shouldBeCalled()
			->willReturn($block)
		;

		$this->beConstructedWith($storage);

		$this->getByStructure($structure)->shouldReturn($block);
	}
}
