<?php namespace Fut7\UserInterface\Controller\Season\CRUD;


use Fut7\Application\Season\CRUD\Find\FindSeasonQuery;
use Fut7\Application\Season\CRUD\Find\FindSeasonUseCase;
use Fut7\Domain\Exception\Season\SeasonNotFoundException;
use Fut7\Infrastructure\Persistence\Season\CsvSeasonRepository;
use Fut7\Infrastructure\Persistence\Shared\CsvRepository;

class FindSeasonController
{
    public const REPOSITORY_FILE = 'Fut7/Data/Season.csv';

    public function execute()
    {
        $repositoryFile = getcwd().'/'.self::REPOSITORY_FILE;

        $randomIdToFind = ['213f2342', '618e60cb2a85e'];
        $id = $randomIdToFind[rand(0,1)];
        echo 'Trying to find Season.id = '.$id.PHP_EOL;

        $query = new FindSeasonQuery($id);

        try {
            $repository = new CsvSeasonRepository(new CsvRepository($repositoryFile));
            $findSeasonUseCase = new FindSeasonUseCase($repository);
            $response = $findSeasonUseCase->execute($query);

            echo PHP_EOL.$response->getResponse()['message'];
            echo PHP_EOL.$response->getResponse()['data'];
        } catch (SeasonNotFoundException $seasonNotFoundException) {
            echo PHP_EOL.'Error found trying to find Season: '.$id.' NOT FOUND';
        }
    }
}