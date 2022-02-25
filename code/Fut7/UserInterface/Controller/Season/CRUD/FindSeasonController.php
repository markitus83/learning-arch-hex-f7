<?php

namespace Fut7\UserInterface\Controller\Season\CRUD;

use Fut7\Application\Season\CRUD\Find\FindSeasonQuery;
use Fut7\Application\Season\CRUD\Find\FindSeasonUseCase;
use Fut7\Domain\Exception\Season\SeasonNotFoundException;
use Fut7\Infrastructure\Persistence\Season\CsvSeasonRepository;
use Fut7\Infrastructure\Persistence\Shared\CsvRepository;

class FindSeasonController
{
    public function execute()
    {
        $randomUuidToFind = ['213f2342', 'c72134eb-e1c0-48eb-b6bf-7119aef18b9f'];
        $uuid = $randomUuidToFind[rand(0,1)];
        echo 'Trying to find Season.uuid = '.$uuid;

        $query = new FindSeasonQuery($uuid);

        try {
            $repository = new CsvSeasonRepository(new CsvRepository(CsvSeasonRepository::repositoryFile()));
            $findSeasonUseCase = new FindSeasonUseCase($repository);
            $response = $findSeasonUseCase->execute($query);

            echo PHP_EOL.$response->getResponse()['message'];
            echo PHP_EOL.$response->getResponse()['data'];
        } catch (SeasonNotFoundException $seasonNotFoundException) {
            echo PHP_EOL.'Error found trying to find Season: '.$uuid.' NOT FOUND';
        }
    }
}