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
        $uuid = 'a169debc-6634-4e6f-ac38-4e8668765886';
        $name = 'NewSeasonName '.date('H.i.s');
        echo 'Trying to update Season '.$uuid.' with new this new name: '.$name.PHP_EOL;

        $seasonDTO = new UpdateSeasonCommand($uuid, $name);

        $repository = new CsvSeasonRepository(new CsvRepository(CsvSeasonRepository::repositoryFile()));
        $updateSeasonUseCase = new UpdateSeasonUseCase($repository);
        $response = $updateSeasonUseCase->execute($seasonDTO);

        echo PHP_EOL.$response->getResponse()['message'];
        echo PHP_EOL.$response->getResponse()['data'];
        echo $repository->showData();
    }
}