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
        $randomUuidToSearch = ['qwe123', '669915f8-786d-4864-a3ee-c9eb0bd131bf'];
        $uuid = $randomUuidToSearch[rand(0,1)];
        $criteriaValue = ['uuid' => $uuid];
        echo 'Trying to search Tournament whith UUID like '.json_encode($criteriaValue).PHP_EOL;

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