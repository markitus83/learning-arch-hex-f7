<?php

namespace Fut7\Infrastructure\Persistence\Shared\Csv;

use Fut7\Infrastructure\Persistence\Shared\CsvRepository;

abstract class Fut7CsvRepository
{
    protected CsvRepository $repository;

    public function __construct(CsvRepository $repository)
    {
        $this->repository = $repository;
    }

    public static function repositoryFile(): string
    {
        return getcwd().'/Fut7/Data/'.get_called_class()::REPOSITORY_FILE;
    }
}