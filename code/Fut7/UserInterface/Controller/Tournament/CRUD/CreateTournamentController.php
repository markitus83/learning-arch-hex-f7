<?php

namespace Fut7\UserInterface\Controller\Tournament\CRUD;

use Fut7\Application\Season\CRUD\Find\FindSeasonQuery;
use Fut7\Application\Season\CRUD\Find\FindSeasonUseCase;
use Fut7\Application\Tournament\CRUD\Create\CreateTournamentCommand;
use Fut7\Domain\Exception\Season\SeasonNotFoundException;
use Fut7\Domain\Exception\Tournament\TournamentCreateException;
use Fut7\Infrastructure\Persistence\Season\CsvSeasonRepository;
use Fut7\Infrastructure\Persistence\Shared\CsvRepository;

class CreateTournamentController
{
    public function execute()
    {
        $id = uniqid();
        $name = 'Liga 2021-2022';
        $season = '618511899fbe4';
        $season = '';
        echo 'Trying to create new Tournament on Season.id = '.$season.PHP_EOL;
        echo 'Data of new Tournament: '.json_encode(['id' => $id, 'name' => $name]).PHP_EOL;

        try{
            $csvSeasonRepository = new CsvSeasonRepository(new CsvRepository(CsvSeasonRepository::repositoryFile()));
            $findSeasonUseCase = new FindSeasonUseCase($csvSeasonRepository);
            $seasonDTO = new FindSeasonQuery($season);
            $season = $findSeasonUseCase->execute($seasonDTO);

            $tournamentDTO = new CreateTournamentCommand($id, $name, $season->season());
        } catch (TournamentCreateException $tournamentCreateException) {
            echo PHP_EOL.'Error found trying to create Torunament: '.$id;
        } catch (SeasonNotFoundException $seasonNotFoundException) {
            echo PHP_EOL.'Error found trying to find Season: '.$season;
        }

    }
}