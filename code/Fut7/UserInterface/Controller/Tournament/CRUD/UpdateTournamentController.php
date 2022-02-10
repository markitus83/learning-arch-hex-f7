<?php

namespace Fut7\UserInterface\Controller\Tournament\CRUD;

use Fut7\Application\Season\CRUD\Find\FindSeasonQuery;
use Fut7\Application\Season\CRUD\Find\FindSeasonUseCase;
use Fut7\Application\Tournament\CRUD\Update\UpdateTournamentCommand;
use Fut7\Application\Tournament\CRUD\Update\UpdateTournamentUseCase;
use Fut7\Domain\Exception\Season\SeasonNotFoundException;
use Fut7\Domain\Exception\Tournament\TournamentCreateException;
use Fut7\Infrastructure\Persistence\Season\CsvSeasonRepository;
use Fut7\Infrastructure\Persistence\Shared\CsvRepository;
use Fut7\Infrastructure\Persistence\Tournament\CsvTournamentRepository;

class UpdateTournamentController
{
    public function execute()
    {
        $uuid = '5c515f49-8086-42cf-afdb-0d27c9d598df';
        $name = 'UpdateTournament_'.date('d.m.H.i.s');
        $season = 'f6eef104-7236-4b62-87d8-c3b77031acdc';
        echo 'Trying to update Tournament '.$uuid.' with this new name '.$name.PHP_EOL;

        try{
            $csvSeasonRepository = new CsvSeasonRepository(new CsvRepository(CsvSeasonRepository::repositoryFile()));
            $findSeasonUseCase = new FindSeasonUseCase($csvSeasonRepository);
            $seasonDTO = new FindSeasonQuery($season);
            $season = $findSeasonUseCase->execute($seasonDTO);

            $repository = new CsvTournamentRepository(new CsvRepository(CsvTournamentRepository::repositoryFile()));
            $tournamentDTO = new UpdateTournamentCommand($uuid, $name, $season->season());
            $updateTournamentUseCase = new UpdateTournamentUseCase($repository);
            $response = $updateTournamentUseCase->execute($tournamentDTO);

            echo PHP_EOL.$response->getResponse()['message'];
            echo PHP_EOL.$response->getResponse()['data'];
            echo $repository->showData();
        } catch (TournamentCreateException $tournamentCreateException) {
            echo PHP_EOL.'Error found trying to create Tournament: '.$uuid;
        } catch (SeasonNotFoundException $seasonNotFoundException) {
            echo PHP_EOL.'Error found trying to find Season: '.$season;
        }
    }
}