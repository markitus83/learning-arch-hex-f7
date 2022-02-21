<?php

namespace Fut7\UserInterface\Controller\Tournament\CRUD;

use Fut7\Application\Season\CRUD\Find\FindSeasonQuery;
use Fut7\Application\Season\CRUD\Find\FindSeasonUseCase;
use Fut7\Application\Tournament\CRUD\Create\CreateTournamentCommand;
use Fut7\Application\Tournament\CRUD\Create\CreateTournamentUseCase;
use Fut7\Domain\Exception\Season\SeasonNotFoundException;
use Fut7\Domain\Exception\Tournament\TournamentCreateException;
use Fut7\Infrastructure\Persistence\Season\CsvSeasonRepository;
use Fut7\Infrastructure\Persistence\Shared\CsvRepository;
use Fut7\Infrastructure\Persistence\Tournament\CsvTournamentRepository;
use Fut7\Infrastructure\Shared\Utils\Uuid;

class CreateTournamentController
{
    public function execute()
    {
        $uuid = new Uuid();
        $name = 'Liga 2021-2022';
        $seasons = ['xxx-1234-fake','f6eef104-7236-4b62-87d8-c3b77031acdc'];
        $season = $seasons[rand(0,1)];
        echo 'Trying to create new Tournament on Season.Uuid = '.$season.PHP_EOL;
        echo 'Data of new Tournament: '.json_encode(['uuid' => $uuid->value(), 'name' => $name]).PHP_EOL;

        try{
            $csvSeasonRepository = new CsvSeasonRepository(new CsvRepository(CsvSeasonRepository::repositoryFile()));
            $findSeasonUseCase = new FindSeasonUseCase($csvSeasonRepository);
            $seasonDTO = new FindSeasonQuery($season);
            $season = $findSeasonUseCase->execute($seasonDTO);

            $csvTournamentRepository = new CsvTournamentRepository(new CsvRepository(CsvTournamentRepository::repositoryFile()));
            $tournamentDTO = new CreateTournamentCommand($uuid, $name, $season->season());
            $createTournamentUseCase = new CreateTournamentUseCase($csvTournamentRepository);
            $response = $createTournamentUseCase->execute($tournamentDTO);

            echo PHP_EOL.$response->getResponse()['message'];
            echo PHP_EOL.$response->getResponse()['data'];
        } catch (TournamentCreateException $tournamentCreateException) {
            echo PHP_EOL.'Error found trying to create Tournament: '.$uuid;
        } catch (SeasonNotFoundException $seasonNotFoundException) {
            echo PHP_EOL.'Error found trying to find Season: '.$season;
        }

    }
}