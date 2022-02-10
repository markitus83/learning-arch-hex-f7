<?php namespace Fut7\UserInterface\Controller\Season\CRUD;


use Fut7\Application\Season\CRUD\Create\CreateSeasonCommand;
use Fut7\Application\Season\CRUD\Create\CreateSeasonUseCase;
use Fut7\Domain\Exception\Season\SeasonCreateException;
use Fut7\Infrastructure\Persistence\Season\CsvSeasonRepository;
use Fut7\Infrastructure\Persistence\Shared\CsvRepository;
use Fut7\Infrastructure\Shared\Utils\Uuid;

class CreateSeasonController
{
    public function execute()
    {
        $uuid = new Uuid();
        $name = 'Tempo 2021-2022';

        $seasonDTO = new CreateSeasonCommand($uuid, $name);

        try {
            $repository = new CsvSeasonRepository(new CsvRepository(CsvSeasonRepository::repositoryFile()));
            $createSeasonUseCase = new CreateSeasonUseCase($repository);
            $response = $createSeasonUseCase->execute($seasonDTO);

            echo PHP_EOL.$response->getResponse()['message'];
            echo PHP_EOL.$response->getResponse()['data'];
        } catch (SeasonCreateException $seasonCreateException) {
            echo PHP_EOL.'Error found trying to create Season: '.$uuid;
        }
    }
}