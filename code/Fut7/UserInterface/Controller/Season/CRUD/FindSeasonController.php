<?php namespace Fut7\UserInterface\Controller\Season\CRUD;


use Fut7\Application\Season\CRUD\Find\FindSeasonQuery;
use Fut7\Application\Season\CRUD\Find\FindSeasonUseCase;
use Fut7\Domain\Exception\Season\SeasonNotFoundException;
use Fut7\Infrastructure\Persistence\Season\CsvSeasonRepository;
use Fut7\Infrastructure\Persistence\Shared\CsvRepository;

class FindSeasonController
{
    public const REPOSITORY_FILE = '/var/www/ddd-f7/code/Fut7/Data/Season.csv';

    public function execute()
    {
        $id = '618511cdbd48e';
        echo 'Trying to find Season.id = '.$id.PHP_EOL;

        $query = new FindSeasonQuery($id);

        try {
            $repository = new CsvSeasonRepository(new CsvRepository(self::REPOSITORY_FILE));
            $seasonUseCase = new FindSeasonUseCase($repository);
            $response = $seasonUseCase->execute($query);

            echo $response->getResponse();
        } catch (SeasonNotFoundException $seasonNotFoundException) {
            echo PHP_EOL.$seasonNotFoundException->getMessage();
        }
    }
}