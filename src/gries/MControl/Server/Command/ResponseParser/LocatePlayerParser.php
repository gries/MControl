<?php
namespace gries\MControl\Server\Command\ResponseParser;

/**
 * Parses the output of a tp command to position: ~0 ~0 ~0 into an array of cooridnates
 *
 * Example:
 *     Teleported gries to 43.25,96.00,195.66
 *
 * @author gries
 *
 */
class LocatePlayerParser implements ResponseParserInterface
{
    protected $playerName;

    public function __construct($playerName)
    {
        $this->playerName = $playerName;
    }

    public function getResponse($response)
    {
        // remove "teleproted xy to"
        $toPos = strpos($response, 'to');
        $coordinates = substr($response, $toPos+2);

        $coordinatesArray = explode(',', $coordinates);

        if (3 != count($coordinatesArray)) {
            return null;
        }

        $filteredCoordinates = array_map('intval', $coordinatesArray);

        return array_combine(array('x', 'y', 'z'), $filteredCoordinates);
    }
}