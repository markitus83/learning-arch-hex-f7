<?php namespace Fut7\UserInterface\Controller\Season\CRUD;


use Fut7\Application\Season\CRUD\Create\CreateSeasonCommand;
use Fut7\Application\Season\CRUD\Create\CreateSeasonUseCase;
use Fut7\Infrastructure\Persistence\Season\CsvSeasonRepository;
use Fut7\Infrastructure\Persistence\Shared\CsvRepository;

class CreateSeasonController
{
    public const REPOSITORY_FILE = '/var/www/ddd-f7/code/Fut7/Data/Season.csv';

    public function execute()
    {
        $id = uniqid();
        $name = 'Tempo 2021-2022';

        $seasonDTO = new CreateSeasonCommand($id, $name);
        var_dump(['seasonDTO' =>$seasonDTO]);

        $repository = new CsvSeasonRepository(new CsvRepository(self::REPOSITORY_FILE));
        $seasonUseCase = new CreateSeasonUseCase($repository);
        $response = $seasonUseCase->execute($seasonDTO);

        echo $response->getResponse();
    }
}