<?php

namespace Fut7\UserInterface\Controller\Season\CRUD;

use Fut7\Application\Season\CRUD\Update\UpdateSeasonCommand;
use Fut7\Application\Season\CRUD\Update\UpdateSeasonUseCase;
use Fut7\Infrastructure\Persistence\Season\CsvSeasonRepository;
use Fut7\Infrastructure\Persistence\Shared\CsvRepository;

class UpdateSeasonController
{
    public const REPOSITORY_FILE = 'Fut7/Data/Season.csv';

    public function execute()
    {
        $repositoryFile = getcwd().'/'.self::REPOSITORY_FILE;

        $id = '618e60cb2a85e';
        $name = 'Update Season '.date('Y.m.d_H.i.s');

        $seasonDTO = new UpdateSeasonCommand($id, $name);

        $repository = new CsvSeasonRepository(new CsvRepository($repositoryFile));
        $updateSeasonUseCase = new UpdateSeasonUseCase($repository);
        $response = $updateSeasonUseCase->execute($seasonDTO);

        echo $response->getResponse()['message'];
        echo PHP_EOL.$response->getResponse()['data'];
    }
}