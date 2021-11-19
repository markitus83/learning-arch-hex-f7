<?php

use Fut7\Domain\Response\Season\UpdateSeasonResponse;
use Fut7\UserInterface\Controller\Season\CRUD\CreateSeasonController;
use Fut7\UserInterface\Controller\Season\CRUD\DeleteSeasonController;
use Fut7\UserInterface\Controller\Season\CRUD\FindSeasonController;
use Fut7\UserInterface\Controller\Season\CRUD\SearchSeasonController;
use Fut7\UserInterface\Controller\Season\CRUD\UpdateSeasonController;

require_once ("vendor/autoload.php");

echo "Learning DDD from scratch".PHP_EOL.PHP_EOL;

//$controller = new CreateSeasonController();
//$controller->execute();

//$controller = new FindSeasonController();
//$controller->execute();

//$controller = new DeleteSeasonController();
//$controller->execute();

//$controller = new SearchSeasonController();
//$controller->execute();

$controller = new UpdateSeasonController();
$controller->execute();