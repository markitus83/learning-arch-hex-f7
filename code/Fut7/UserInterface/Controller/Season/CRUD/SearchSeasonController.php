<?php

namespace Fut7\UserInterface\Controller\Season\CRUD;

use Fut7\Application\Season\CRUD\Search\SearchSeasonQuery;
use Fut7\Application\Season\CRUD\Search\SearchSeasonUseCase;
use Fut7\Infrastructure\Persistence\Season\CsvSeasonRepository;
use Fut7\Infrastructure\Persistence\Shared\CsvRepository;

class SearchSeasonController
{
    public function execute()
    {
        $randomUuidToSearch = ['qwe233', '61851', 'c72134eb-e1c0-48eb-b6bf-7119aef18b9f'];
        $uuid = $randomUuidToSearch[rand(0,2)];
        $criteriaValue = ['uuid' => $uuid];
        echo 'Trying to search Seasons with UUID like '.json_encode($criteriaValue).PHP_EOL;

        $criteria = new SearchSeasonQuery($criteriaValue);

        $repository = new CsvSeasonRepository(new CsvRepository(CsvSeasonRepository::repositoryFile()));
        $searchSeasonUseCase = new SearchSeasonUseCase($repository);
        $response = $searchSeasonUseCase->execute($criteria->criteria());

        echo PHP_EOL.$response->getResponse()['message'];
        foreach ($response->getResponse()['data'] as $data) {
            echo PHP_EOL . json_encode($data);
        }
    }
}