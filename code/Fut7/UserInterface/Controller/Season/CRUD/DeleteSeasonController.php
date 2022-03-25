<?php

namespace Fut7\UserInterface\Controller\Season\CRUD;

use Fut7\Application\Season\CRUD\Delete\DeleteSeasonUseCase;
use Fut7\Domain\Exception\Season\SeasonDeleteException;
use Fut7\Domain\Exception\Season\SeasonNotFoundException;
use Fut7\Infrastructure\Persistence\Season\CsvSeasonRepository;
use Fut7\Infrastructure\Persistence\Shared\CsvRepository;

class DeleteSeasonController
{
    public function execute()
    {
        $uuid = '47784ab8-0142-4193-8cdf-9c723ccb4b56';
        echo 'Trying to delete Season.id = '.$uuid;

        try {
            $repository = new CsvSeasonRepository(new CsvRepository(CsvSeasonRepository::repositoryFile()));
            $deleteSeasonUseCase = new DeleteSeasonUseCase($repository);
            $response = $deleteSeasonUseCase->execute($uuid);

            echo PHP_EOL.$response->getResponse()['message'];
            echo PHP_EOL.$response->getResponse()['data'];
        } catch (SeasonNotFoundException $seasonNotFoundException) {
            echo PHP_EOL.'Error found trying to find Season to delete: '.$uuid. ' NOT FOUND';
        } catch (SeasonDeleteException $seasonDeleteException) {
            echo PHP_EOL.'Error found trying to delete Season: '.$uuid;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}