<?php

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

require_once ("vendor/autoload.php");

use Fut7\UserInterface\Controller\Tournament\CRUD\SearchTournamentController;
use Symfony\Component\Console\Application;

//$application = new Application();
//$application->add(new ViewSeasonDataCommand());
//$application->run();

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
    }
}