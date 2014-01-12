<?php
namespace gries\MControl\Server;

use gries\MControl\Builder\BlockType;
use gries\MControl\Server\Command;
use gries\MControl\Server\Rcon\RconManager;

class Commander
{
    /**
     * @var RconManager
     */
    protected $rconManager;

    /**
     * @param RconManager $rconManager
     */
    public function __construct(RconManager $rconManager)
    {
        $this->rconManager = $rconManager;
    }

    /**
     * Say something to all Players on the server
     *
     * @param string $text
     * @return boolean if Command was executed
     */
    public function say($text)
    {
        return $this->executeCommand(new Command\Say($text));
    }

    /**
     * Get a list of all Players on the server
     *
     * @return array ListOfPlayers
     */
    public function listPlayers()
    {
        return $this->executeCommand(new Command\ListPlayers());
    }

    public function locatePlayer($player)
    {
        return $this->executeCommand(new Command\LocatePlayer(array($player, '~0', '~0', '~0')));
    }

    public function teleport(array $subjects)
    {
        return $this->executeCommand(new Command\Teleport($subjects));
    }

    public function give($player, $itemId, $amount)
    {
        return $this->executeCommand(new Command\Give($player, $itemId, $amount));
    }

    public function setWeather($weatherType)
    {
        return $this->executeCommand(new Command\Weather($weatherType));
    }

    public function setTime($time)
    {
        return $this->executeCommand(new Command\SetTime($time));
    }

    public function setBlock($type, array $coordinates, $meta = 0)
    {
        $this->executeCommand(new Command\SetBlock(
            $type,
            $coordinates,
            Command\SetBlock::SET_METHOD_REPLACE,
            $meta
        ));
    }

    public function raw($command)
    {
        return $this->executeCommand(new Command\Raw($command));
    }

    public function testForBlock(array $coordinates, BlockType $type, $meta = null)
    {
        return $this->executeCommand(new Command\TestForBlock($coordinates, $type, $meta));
    }

    /**
     * Execute the Command on the Minecraftserver
     * via the RconManager
     *
     * @param Command $command
     */
    protected function executeCommand(Command\CommandInterface $command)
    {
        try {

            return $this->rconManager->execute($command);
        } catch(\RuntimeException $e) {

            return false;
        }
    }
}
