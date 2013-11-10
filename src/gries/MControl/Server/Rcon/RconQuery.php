<?php

namespace gries\MControl\Server\Rcon;

$reflection = new \ReflectionProperty('\SourceQuery', 'Connected');
$reflection->setAccessible(true);

/**
 * Class RconQuery
 *
 * @property bool $Connected
 *
 * @package gries\MControl\Server
 */
class RconQuery extends \SourceQuery
{
//	public function __destruct( )
//	{
//		if ($this->isConnected())
//		{
//			$this->Disconnect();
//		}
//	}
//
//    public function setConnected($connected)
//    {
//        $this->Connected = $connected;
//    }
//
//	public function isConnected()
//	{
//		return $this->Connected;
//	}
}
