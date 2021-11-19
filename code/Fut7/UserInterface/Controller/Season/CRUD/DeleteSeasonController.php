<?php namespace Fut7\UserInterface\Controller\Season\CRUD;


use Fut7\Application\Season\CRUD\Delete\DeleteSeasonUseCase;
use Fut7\Domain\Exception\Season\SeasonDeleteException;
use Fut7\Domain\Exception\Season\SeasonNotFoundException;
use Fut7\Infrastructure\Persistence\Season\CsvSeasonRepository;
use Fut7\Infrastructure\Persistence\Shared\CsvRepository;

class DeleteSeasonController
{
    public const REPOSITORY_FILE = 'Fut7/Data/Season.csv';

    public function execute()
    {
        $repositoryFile = getcwd().'/'.self::REPOSITORY_FILE;

        $id = '618512435f5a0';
        echo 'Trying to delete Season.id = '.$id.PHP_EOL;

        try {
            $repository = new CsvSeasonRepository(new CsvRepository($repositoryFile));
            $deleteSeasonUseCase = new DeleteSeasonUseCase($repository);
            $response = $deleteSeasonUseCase->execute($id);

            echo PHP_EOL.$response->getResponse()['message'];
            echo PHP_EOL.$response->getResponse()['data'];
        } catch (SeasonNotFoundException $seasonNotFoundException) {
            echo PHP_EOL.$seasonNotFoundException->getMessage();
            echo PHP_EOL.'Error found trying to find Season to delete: '.$id. ' NOT FOUND';
        } catch (SeasonDeleteException $seasonDeleteException) {
            echo PHP_EOL.'Error found trying to delete Season: '.$id;
        }
    }
}