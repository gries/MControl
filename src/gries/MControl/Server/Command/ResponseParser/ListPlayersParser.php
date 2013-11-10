<?php
namespace gries\MControl\Server\Command\ResponseParser;

/**
 * Parses the output of a "list" command into an array of online players
 *
 * Example:
 *     There are 5/20 players online
 *  gries
 *  somether
 *  foo
 *  bar
 *  gunther
 *
 * @author gries
 *
 */
class ListPlayersParser implements ResponseParserInterface
{
    public function getResponse($response)
    {
        $playerNames = strstr($response, 'online:');
        $playerNames = str_replace(array(' ', 'online:'), '', $playerNames);

        return explode(',', $playerNames);
    }
}