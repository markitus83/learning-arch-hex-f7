<?php

namespace Fut7\UserInterface\Controller\Season\CRUD;

use Fut7\Application\Season\CRUD\Update\UpdateSeasonCommand;
use Fut7\Application\Season\CRUD\Update\UpdateSeasonUseCase;
use Fut7\Infrastructure\Persistence\Season\CsvSeasonRepository;
use Fut7\Infrastructure\Persistence\Shared\CsvRepository;

class UpdateSeasonController
{
    public function execute()
    {
        $id = '618e60cb2a85e';
        $name = 'NewSeasonName '.date('H.i.s');
        echo 'Trying to update Season '.$id.' with new this new name: '.$name.PHP_EOL;

        $seasonDTO = new UpdateSeasonCommand($id, $name);

        $repository = new CsvSeasonRepository(new CsvRepository(CsvSeasonRepository::repositoryFile()));
        $updateSeasonUseCase = new UpdateSeasonUseCase($repository);
        $response = $updateSeasonUseCase->execute($seasonDTO);

        echo PHP_EOL.$response->getResponse()['message'];
        echo PHP_EOL.$response->getResponse()['data'];
        echo $repository->showData();
    }
}