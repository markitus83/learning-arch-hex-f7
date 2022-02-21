<?php

namespace Fut7\UserInterface\Controller\Tournament\CRUD;

use Fut7\Application\Tournament\CRUD\Delete\DeleteTournamentUseCase;
use Fut7\Domain\Exception\Tournament\TournamentDeleteException;
use Fut7\Domain\Exception\Tournament\TournamentNotFoundException;
use Fut7\Infrastructure\Persistence\Shared\CsvRepository;
use Fut7\Infrastructure\Persistence\Tournament\CsvTournamentRepository;

class DeleteTournamentController
{
    public function execute()
    {
        $uuid = '211c4898-d4dd-4920-9501-2ec7a5a62e25';
        echo 'Trying to delete Tournament.uuid '.$uuid;

        try {
            $tournamentRepository = new CsvTournamentRepository(new CsvRepository(CsvTournamentRepository::repositoryFile()));
            $deleteTournamentUseCase = new DeleteTournamentUseCase($tournamentRepository);
            $response = $deleteTournamentUseCase->execute($uuid);

            echo PHP_EOL.$response->getResponse()['message'];
            echo PHP_EOL.$response->getResponse()['data'];
        } catch (TournamentNotFoundException $tournamentNotFoundException) {
            echo PHP_EOL.'Error found trying to find Tournament to delete: '.$uuid.' NOT FOUND';
        } catch (TournamentDeleteException $tournamentDeleteException) {
            echo PHP_EOL.'Error found trying to delete Tournament: '.$uuid;
        }
    }
}