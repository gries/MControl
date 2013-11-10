<?php

namespace gries\MControl\Server\Command;

class Give implements Command
{
	protected $player;

	protected $itemId;

	protected $amount;

	public function __construct($player, $itemId, $amount)
	{
		$this->player = $player;
		$this->itemId = $itemId;
		$this->amount = $amount;
	}

	public function getCommandString()
	{
		return sprintf('give %s %s %s', $this->player, $this->itemId, $this->amount);
	}

	/**
	 * @return ResponseParser\ResponseParserInterface|null
	 */
	public function getResponseParser()
	{
		return null;
	}
}
