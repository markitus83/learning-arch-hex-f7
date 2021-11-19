<?php

namespace Fut7\UserInterface\Controller\Season\CRUD;

use Fut7\Application\Season\CRUD\Search\SearchSeasonQuery;
use Fut7\Application\Season\CRUD\Search\SearchSeasonUseCase;
use Fut7\Infrastructure\Persistence\Season\CsvSeasonRepository;
use Fut7\Infrastructure\Persistence\Shared\CsvRepository;

class SearchSeasonController
{
    public const REPOSITORY_FILE = 'Fut7/Data/Season.csv';

    public function execute()
    {
        $repositoryFile = getcwd().'/'.self::REPOSITORY_FILE;

        $criteriaValue = ['id'=>'qwe233'];
//        $criteriaValue = ['id'=>'61851'];
        echo 'Trying to search Seasons with id like '.json_encode($criteriaValue).PHP_EOL;

        $criteria = new SearchSeasonQuery($criteriaValue);

        $repository = new CsvSeasonRepository(new CsvRepository($repositoryFile));
        $searchSeasonUseCase = new SearchSeasonUseCase($repository);
        $response = $searchSeasonUseCase->execute($criteria->criteria());

        echo PHP_EOL.$response->getResponse()['message'];
        foreach ($response->getResponse()['data'] as $data) {
            echo PHP_EOL . json_encode($data);
        }
    }
}