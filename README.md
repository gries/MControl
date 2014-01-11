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
        },
         "minimum-stability": "dev"
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
        $structure->createBlock('sand', array('x' => 1, 'y' => $i, 'z' => 1));
    }

    // add a row of 3 sand blocks on the Y axis
    // starting on 1:1:1
    $structure->addRow('y', 'sand', 3);

    // build it on the server
    $structureBuilder->build($structure);

Converting images to Structures
-------------------------------
To convert images to structures the imagick extension for PHP is required.

The example below will build a structure that is 5 blocks high, and is made of air and leaves.
Every black pixel will be leaves every white pixel will be air. The structure will be placed on x -> 33, z -> 19

The result can be seen in this video: https://vimeo.com/79598411

    $converter = new ImageToStructureConverter();
    $converter->setBlackBlockType('leaves');
    $converter->setWhiteBlockType('air');

    $image     = new Imagick('test.png');
    $structure = $converter->convert($image, 5);
    $structureBuilder->build($structure,
        array('x' => '-33',
              'y' => '3',
              'z' => '19')
    );

Saving structures for further use
---------------------------------
You can persist structures for later use using the StructureRepository.
Currently this Repository uses a sqlite database to store the data by default,
this behavior can be easily changed by creating a custom EntityManager by yourself
and passing it to the StructureRepositoryFactory.

    // bootstrap doctrine
    $entityManager = require_once __DIR__ . '/bootstrap.php';

    // create a repository
    $factory = new StructureRepositoryFactory();
    $repository = $factory->create($entityManager);

    // create a new structure
    $structure = new Structure();
    $structure->createBlock('iron', array('x' => 1, 'y' => 1, 'z' => 1));
    $structure->setName('greatness');

    // save it to the database
    $repository->add($structure);

    // get it from the database
    $repository->getByName('greatness');

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

Contribute!
-----------
Feel free to give me feedback/feature-request/bug-reports via. github issues.
Or just send me a pull-request :)


Author
------

- [Christoph Rosse](http://twitter.com/griesx)

License
-------

For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
