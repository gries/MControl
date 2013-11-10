MControl
========

MControl is a library to controll a minecraft-server via. the rcon protocol.

Installation
------------

MControl can be installed via. Composer:

    {
        "require": {
            "gries/MControl": "dev-master"
        }
    }

Basic usage
-----------
    use gries\MControl\Server\Commander;
    use gries\MControl\Server\Rcon\RconManager;

    // create a RconConnection
    $rcon = new RconManager('localhost', 25575, 'p4ssw0rd');

    // create a Commander
    $commander = new Commander($rcon);

    // set the server-time
    $commander->setTime('12000');

    // listPlayers
    $players = $commander->listPlayers(); // -> array('playerx', 'playery');

    // teleport one player to another
    $commander->teleport(array('playerx', 'playery'));

    // locate a player
    $location = $commander->locate('playerx');  // -> array('x' => 157, 'y' => 50, 'z' => -54);

Currently these Commands are available
--------------------------------------

- say
- listPlayers
- locatePlayer
- teleport
- give
- setWeather
- setTime


Running the tests
-----------------
    bin/phpspec run

Author
------

- [Christoph Rosse](http://twitter.com/griesx)

License
-------

For the full copyright and license information, please view the LICENSE file that was distributed with this source code.