<?php

namespace gries\MControl\Server\Rcon;

use gries\MControl\Server\Command\Command;

class RconManager
{
    protected $rcon;

    protected $host;

    /**
     * @param mixed $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param null $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return null
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param int $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param \SourceQuery $rcon
     */
    public function setRcon(\SourceQuery $rcon)
    {
        $this->rcon = $rcon;
    }

    /**
     * @return \SourceQuery
     */
    public function getRcon()
    {
        return $this->rcon;
    }

    protected $port;

    protected $password;

    /**
     * Create a new query instance
     *
     * @param      $host
     * @param int  $port
     * @param null $password
     */
    public function __construct($host, $port = 25575, $password = null)
    {
        $this->host = $host;
        $this->port = $port;
        $this->password = $password;
        $this->rcon = new RconQuery();
        $this->rcon->Connect($this->host, $this->port, 3);
    }

    /**
     * Connect to the server and send a command
     *
     * @param Command $command
     *
     * @return bool|mixed|string
     */
    public function execute(Command $command)
    {
        $this->rcon->SetRconPassword($this->password);

        $returnValue = $this->rcon->Rcon($command->getCommandString());

        if ($parser = $command->getResponseParser())
        {
            return $parser->getResponse($returnValue);
        }

        return $returnValue;
    }
}
