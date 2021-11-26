<?php

use Fut7\Domain\Response\Season\UpdateTournamentResponse;
use Fut7\UserInterface\Controller\Season\CRUD\CreateSeasonController;
use Fut7\UserInterface\Controller\Season\CRUD\DeleteSeasonController;
use Fut7\UserInterface\Controller\Season\CRUD\FindSeasonController;
use Fut7\UserInterface\Controller\Season\CRUD\SearchSeasonController;
use Fut7\UserInterface\Controller\Season\CRUD\UpdateSeasonController;
use Fut7\UserInterface\Controller\Tournament\CRUD\CreateTournamentController;

require_once ("vendor/autoload.php");

echo 'Learning DDD from scratch'.PHP_EOL.PHP_EOL;
echo 'Menu:'.PHP_EOL;
echo '1 - Create new Season'.PHP_EOL;
echo '2 - Find Season'.PHP_EOL;
echo '3 - Delete Season'.PHP_EOL;
echo '4 - Search Season'.PHP_EOL;
echo '5 - Update Season'.PHP_EOL;

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
    }
}

//*************************//
//*************************//

//$controller = new CreateTournamentController();
//$controller->execute();