MControl
========

MControl is a library to controll a minecraft-server via. the rcon protocol.

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/33bb71fa-7445-42bd-a1e4-02f956b73ccc/big.png)](https://insight.sensiolabs.com/projects/33bb71fa-7445-42bd-a1e4-02f956b73ccc)

[![Build Status](https://travis-ci.org/gries/MControl.png?branch=master)](https://travis-ci.org/gries/MControl)

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

Building structures
-------------------

        ....
        use gries\MControl\Builder\Block;
        use gries\MControl\Builder\Structure;
        use gries\MControl\Server\StructureBuilder;
        ...

        // create a structure-builder
        $structureBuilder = new StructureBuilder($commander);

        // create a new structure
        $structure = new Structure();

        // add some blocks
        // in this case build a sand tower that is five blocks high
        for ($i = 0; $i < 5; $i++)
        {
            $block = new Block('sand', array('x' => 1, 'y' => $i, 'z' => 1));
            $structure->addBlock($block);
        }

        // build it on the server
        $structureBuilder->build($structure);


Currently these Commands are available for the Commander
-------------------------------------------------------

- say
- listPlayers
- locatePlayer
- teleport
- give
- setWeather
- setTime
- setBlock


Running the tests
-----------------
    bin/phpspec run

Author
------

- [Christoph Rosse](http://twitter.com/griesx)

License
-------

For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
