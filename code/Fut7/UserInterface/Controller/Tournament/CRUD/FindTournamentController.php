<?php

namespace Fut7\UserInterface\Controller\Tournament\CRUD;

use Fut7\Application\Tournament\CRUD\Find\FindTournamentQuery;
use Fut7\Application\Tournament\CRUD\Find\FindTournamentUseCase;
use Fut7\Domain\Exception\Tournament\TournamentNotFoundException;
use Fut7\Infrastructure\Persistence\Shared\CsvRepository;
use Fut7\Infrastructure\Persistence\Tournament\CsvTournamentRepository;

class FindTournamentController
{
    public function execute()
    {
        $randomIdToFind = ['123trf33', '61ba1d35dc123'];
        $id = $randomIdToFind[rand(0,1)];
        echo 'Trying to find Tournament.id = '.$id.PHP_EOL;

        $query = new FindTournamentQuery($id);

        try {
            $repository = new CsvTournamentRepository(new CsvRepository(CsvTournamentRepository::repositoryFile()));
            $findTournament = new FindTournamentUseCase($repository);
            $response = $findTournament->execute($query);

            echo PHP_EOL.$response->getResponse()['message'];
            echo PHP_EOL.$response->getResponse()['data'];
        } catch (TournamentNotFoundException $tournamentNotFoundException) {
            echo PHP_EOL.'Error found trying to find Tournament: '.$id.' NOT FOUND';
        }
    }
}