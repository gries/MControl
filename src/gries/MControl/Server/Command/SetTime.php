<?php

namespace gries\MControl\Server\Command;

class SetTime implements Command
{
	protected $time;

	public function __construct($time)
	{
		$this->time = $time;
	}

	/**
	 * @return string
	 */
	public function getCommandString()
	{
		return sprintf('time set %s', $this->time);
	}

	/**
	 * @return ResponseParser\ResponseParserInterface|null
	 */
	public function getResponseParser()
	{
		return null;
	}
}
