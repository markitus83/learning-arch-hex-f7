<?php

namespace Fut7\UserInterface\Controller\Tournament\CRUD;

use Fut7\Infrastructure\Persistence\Shared\CsvRepository;
use Fut7\Infrastructure\Persistence\Tournament\CsvTournamentRepository;

class ViewTournamentController
{
    public function execute()
    {
        $repository = new CsvTournamentRepository(new CsvRepository(CsvTournamentRepository::repositoryFile()));
        $repository->showData();
    }
}