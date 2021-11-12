<?php

use Fut7\UserInterface\Controller\Season\CRUD\CreateSeasonController;
use Fut7\UserInterface\Controller\Season\CRUD\DeleteSeasonController;
use Fut7\UserInterface\Controller\Season\CRUD\FindSeasonController;

require_once ("vendor/autoload.php");

echo "Learning DDD from scratch".PHP_EOL.PHP_EOL;

//$controller = new CreateSeasonController();
//$controller->execute();

//$controller = new FindSeasonController();
//$controller->execute();

$controller = new DeleteSeasonController();
$controller->execute();


