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

}
