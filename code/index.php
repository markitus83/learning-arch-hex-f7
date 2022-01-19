<?php

require_once ("vendor/autoload.php");

use Fut7\UserInterface\Controller\Season\CRUD\CreateSeasonController;
use Fut7\UserInterface\Controller\Season\CRUD\DeleteSeasonController;
use Fut7\UserInterface\Controller\Season\CRUD\FindSeasonController;
use Fut7\UserInterface\Controller\Season\CRUD\SearchSeasonController;
use Fut7\UserInterface\Controller\Season\CRUD\UpdateSeasonController;
use Fut7\UserInterface\Controller\Season\CRUD\ViewSeasonController;
use Fut7\UserInterface\Controller\Tournament\CRUD\CreateTournamentController;
use Fut7\UserInterface\Controller\Tournament\CRUD\DeleteTournamentController;
use Fut7\UserInterface\Controller\Tournament\CRUD\FindTournamentController;
use Fut7\UserInterface\CLI\Command\ViewSeasonDataCommand;


use Fut7\UserInterface\Controller\Tournament\CRUD\SearchTournamentController;
use Fut7\UserInterface\Controller\Tournament\CRUD\UpdateTournamentController;
use Fut7\UserInterface\Controller\Tournament\CRUD\ViewTournamentController;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Application;

//$application = new Application();
//$application->add(new ViewSeasonDataCommand());
//$application->run();

//***************************************//

    // Generate a version 1 (time-based) UUID object
    $uuid1 = Uuid::uuid1();
    echo $uuid1->toString() . "\n"; // i.e. e4eaaaf2-d142-11e1-b3e4-080027620cdd

    // Generate a version 3 (name-based and hashed with MD5) UUID object
    $uuid3 = Uuid::uuid3(Uuid::NAMESPACE_DNS, 'php.net');
    echo $uuid3->toString() . "\n"; // i.e. 11a38b9a-b3da-360f-9353-a5a725514269

    // Generate a version 4 (random) UUID object
    $uuid4 = Uuid::uuid4();
    echo $uuid4->toString() . "\n"; // i.e. 25769c6c-d34d-4bfe-ba98-e0ee856f3e7a

    // Generate a version 5 (name-based and hashed with SHA1) UUID object
    $uuid5 = Uuid::uuid5(Uuid::NAMESPACE_DNS, 'php.net');
    echo $uuid5->toString() . "\n"; // i.e. c4a760a8-dbcf-5254-a0d9-6a4474bd1b62

    $uuid = Uuid::uuid4();
    var_dump($uuid);



//***************************************//

echo 'Learning DDD from scratch'.PHP_EOL.PHP_EOL;
echo 'Menu:'.PHP_EOL;
echo '1 - Create new Season'.PHP_EOL;
echo '2 - Find Season'.PHP_EOL;
echo '3 - Delete Season'.PHP_EOL;
echo '4 - Search Season'.PHP_EOL;
echo '5 - Update Season'.PHP_EOL;
echo '6 - View Season data'.PHP_EOL;
echo '<===================>'.PHP_EOL;
echo '7 - Create new Tournament'.PHP_EOL;
echo '8 - Find Tournament'.PHP_EOL;
echo '9 - Delete Tournament'.PHP_EOL;
echo '10 - Search Tournament'.PHP_EOL;
echo '11 - Update Tournament'.PHP_EOL;
echo '12 - View Tournament data'.PHP_EOL;

echo PHP_EOL;

if (isset($argv[1])) {
    $option = $argv[1];
    switch ($option) {
        case 1:
            echo '## Create Season'.PHP_EOL;
            $controller = new CreateSeasonController();
            $controller->execute();
            break;
        case 2:
            echo '## Find Season'.PHP_EOL;
            $controller = new FindSeasonController();
            $controller->execute();
            break;
        case 3:
            echo '## Delete Season'.PHP_EOL;
            $controller = new DeleteSeasonController();
            $controller->execute();
            break;
        case 4:
            echo '## Search Season'.PHP_EOL;
            $controller = new SearchSeasonController();
            $controller->execute();
            break;
        case 5:
            echo '## Update Season'.PHP_EOL;
            $controller = new UpdateSeasonController();
            $controller->execute();
            break;
        case 6:
            echo '## View Season data'.PHP_EOL;
            $controller = new ViewSeasonController();
            $controller->execute();
            break;
        case 7:
            echo '## Create Tournament'.PHP_EOL;
            $controller = new CreateTournamentController();
            $controller->execute();
            break;
        case 8:
            echo '## Find Tournament'.PHP_EOL;
            $controller = new FindTournamentController();
            $controller->execute();
            break;
        case 9:
            echo '## Delete Tournament'.PHP_EOL;
            $controller = new DeleteTournamentController();
            $controller->execute();
            break;
        case 10:
            echo '## Search Tournament'.PHP_EOL;
            $controller = new SearchTournamentController();
            $controller->execute();
            break;
        case 11:
            echo '## Update Tournament'.PHP_EOL;
            $controller = new UpdateTournamentController();
            $controller->execute();
            break;
        case 12:
            echo '## View Tournament data'.PHP_EOL;
            $controller = new ViewTournamentController();
            $controller->execute();
            break;
    }
}