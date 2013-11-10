<?php

namespace gries\MControl\Server\Command;

class Weather implements Command
{
	protected $type;

	protected $seconds;

	protected $validTypes = array('clear', 'thunder', 'rain');

	public function __construct($weatherType, $seconds = 900)
	{
		if (!in_array($weatherType, $this->validTypes)) {
			throw new \InvalidArgumentException('Invalid weather-type given!');
		}

		$this->type = $weatherType;
		$this->seconds = $seconds;
	}

	/**
	 * @return string
	 */
	public function getCommandString()
    {
        return sprintf('weather %s %s', $this->type, $this->seconds);
    }

	/**
	 * @return ResponseParser\ResponseParserInterface|null
	 */
	public function getResponseParser()
	{
		return null;
	}
}
