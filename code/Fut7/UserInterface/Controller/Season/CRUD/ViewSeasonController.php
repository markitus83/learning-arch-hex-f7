<?php

namespace Fut7\UserInterface\Controller\Season\CRUD;

use Fut7\Infrastructure\Persistence\Season\CsvSeasonRepository;
use Fut7\Infrastructure\Persistence\Shared\CsvRepository;

class ViewSeasonController
{
    public function execute()
    {
        $repository = new CsvSeasonRepository(new CsvRepository(CsvSeasonRepository::repositoryFile()));
        $repository->showData();
    }
}