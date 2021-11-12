<?php namespace Fut7\UserInterface\Controller\Season\CRUD;


use Fut7\Application\Season\CRUD\Delete\DeleteSeasonUseCase;
use Fut7\Application\Season\CRUD\Find\FindSeasonQuery;
use Fut7\Application\Season\CRUD\Find\FindSeasonUseCase;
use Fut7\Domain\Exception\Season\SeasonNotFoundException;
use Fut7\Infrastructure\Persistence\Season\CsvSeasonRepository;
use Fut7\Infrastructure\Persistence\Shared\CsvRepository;

class DeleteSeasonController
{
    public const REPOSITORY_FILE = '/var/www/ddd-f7/code/Fut7/Data/Season.csv';

    public function execute()
    {
        $id = '618512435f5a0';
        echo 'Trying to delete Season.id = '.$id.PHP_EOL;

        try {
            $repository = new CsvSeasonRepository(new CsvRepository(self::REPOSITORY_FILE));
            $seasonUseCase = new DeleteSeasonUseCase($repository);
            $response = $seasonUseCase->execute($id);

            echo $response->getResponse();
        } catch (SeasonNotFoundException $seasonNotFoundException) {
            echo PHP_EOL.$seasonNotFoundException->getMessage();
        }
    }
}