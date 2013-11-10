<?php
namespace gries\MControl\Server\Command\ResponseParser;

/**
 * A ResponseParser is responsible for parsing
 * and interpreting the loglines the minecraftserver produces after
 * a Command is executed
 *
 *
 * @author gries
 */
interface ResponseParserInterface
{
	/**
	 * Get the Server response
	 *
	 * @param array $lines
	 * @return mixed Response could be a string or an array
	 */
	public function getResponse($response);
}