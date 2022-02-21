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

$int = 14;
$string = 'string';
$uuid = new \Fut7\Infrastructure\Shared\Utils\Uuid();
$uuid_instance = $uuid instanceof \Fut7\Infrastructure\Shared\Utils\Uuid;

var_dump(
    [
        'int'=>gettype($int),
        'string'=>gettype($string),
        'uuid' => gettype($uuid),
        'uuid_instance' => $uuid_instance
    ]
);
die('fin');

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