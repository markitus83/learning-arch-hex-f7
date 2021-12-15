<?php

namespace Fut7\UserInterface\Controller\Tournament\CRUD;

use Fut7\Application\Tournament\CRUD\Delete\DeleteTournamentUseCase;
use Fut7\Domain\Exception\Tournament\TournamentDeleteException;
use Fut7\Domain\Exception\Tournament\TournamentNotFoundException;
use Fut7\Infrastructure\Persistence\Season\CsvSeasonRepository;
use Fut7\Infrastructure\Persistence\Shared\CsvRepository;
use Fut7\Infrastructure\Persistence\Tournament\CsvTournamentRepository;

class DeleteTournamentController
{
    public function execute()
    {
        $id = '61a9dbb5e0c4d';
        echo 'Trying to delete Tournament.id '.$id;

        try {
            $tournamentRepository = new CsvTournamentRepository(new CsvRepository(CsvTournamentRepository::repositoryFile()));
            $seasonRepository = new CsvSeasonRepository(new CsvRepository(CsvSeasonRepository::repositoryFile()));
            $deleteTournamentUseCase = new DeleteTournamentUseCase($tournamentRepository, $seasonRepository);
            $response = $deleteTournamentUseCase->execute($id);

            echo PHP_EOL.$response->getResponse()['message'];
            echo PHP_EOL.$response->getResponse()['data'];
        } catch (TournamentNotFoundException $tournamentNotFoundException) {
            echo PHP_EOL.'Error found trying to find Tournament to delete: '.$id.' NOT FOUND';
        } catch (TournamentDeleteException $tournamentDeleteException) {
            echo PHP_EOL.'Error found trying to delete Tournament: '.$id;
        }
    }
}