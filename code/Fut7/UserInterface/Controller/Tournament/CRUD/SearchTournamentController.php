<?php

namespace Fut7\UserInterface\Controller\Tournament\CRUD;

use Fut7\Application\Tournament\CRUD\Search\SearchTournamentQuery;
use Fut7\Application\Tournament\CRUD\Search\SearchTournamentUseCase;
use Fut7\Infrastructure\Persistence\Shared\CsvRepository;
use Fut7\Infrastructure\Persistence\Tournament\CsvTournamentRepository;

class SearchTournamentController
{
    public function execute()
    {
        $randomIdToSearch = ['qwe123', '61a9d', ''];
        $id = $randomIdToSearch[rand(0,2)];
        $criteriaValue = ['id' => $id];
        echo 'Trying to search Tournament whith id like '.json_encode($criteriaValue).PHP_EOL;

        $criteria = new SearchTournamentQuery($criteriaValue);

        $repository = new CsvTournamentRepository(new CsvRepository(CsvTournamentRepository::repositoryFile()));
        $searchTournamentUseCase = new SearchTournamentUseCase($repository);
        $response = $searchTournamentUseCase->execute($criteria->criteria());

        echo PHP_EOL.$response->getResponse()['message'];
        foreach ($response->getResponse()['data'] as $data) {
            echo PHP_EOL.json_encode($data);
        }
    }
}