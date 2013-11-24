<?php

namespace gries\MControl\Server\Command\ResponseParser;

class TestForBlockParser implements ResponseParserInterface
{

    /**
     * Get the Server response
     *
     * @param $response
     *
     * @return mixed Response could be a string or an array
     */
    public function getResponse($response)
    {
        // block was detected
        if (false !== strpos($response, 'Successfully found')) {
            return true;
        }

        // only meta index is wrong
        if (false !== strpos($response, 'value of')) {
            // find format: ... data value of 4 (expected: 0)
            $regex = "/value of ([a-zA-Z0-9_]*) \(expected/";

            $matches = array();
            preg_match_all($regex, $response, $matches);

            return $matches[1][0];
        }

        if (false !== $tilePos = strpos($response, 'is tile.')) {
            // find format: ... is tile.air.name (expected: somethingelse)
            $regex = "/is tile.([a-zA-Z0-9_]*).name/";

            $matches = array();
            preg_match_all($regex, $response, $matches);

            return 'minecraft:' . $matches[1][0];
        }

        // find format: ... is Wooden Planks (expected: somethingelse)
        $regex   = "/is ([a-zA-Z0-9_\ ]*) \(expected/";
        $matches = array();

        preg_match_all($regex, $response, $matches);

        if (!isset($matches[1][0])) {
            throw new \LogicException(sprintf('Cant handle response: "%s" while parsing a TestForBlockOutput', $response));
        }

        return $matches[1][0];
    }
}
