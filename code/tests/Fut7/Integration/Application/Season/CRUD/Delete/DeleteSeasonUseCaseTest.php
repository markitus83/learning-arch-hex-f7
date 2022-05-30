<?php

namespace Fut7\Integration\Application\Season\CRUD\Delete;

use Fut7\Application\Season\CRUD\Delete\DeleteSeasonUseCase;

use Fut7\Domain\Exception\Season\SeasonNotFoundException;
use Fut7\Domain\Exception\Season\SeasonUuidException;
use Fut7\Domain\Response\Season\DeleteSeasonResponse;
use Fut7\Infrastructure\Persistence\Season\CsvSeasonRepository;
use Fut7\Infrastructure\Persistence\Shared\CsvRepository;
use Fut7\Infrastructure\Shared\Utils\Uuid;
use PHPUnit\Framework\TestCase;

class DeleteSeasonUseCaseTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        if (!is_dir(getcwd().'/tests/Fut7/Data')) {
            mkdir(getcwd().'/tests/Fut7/Data');
        }

        if (file_exists(getcwd().'/tests/Fut7/Data/SeasonTest.csv')) {
            unlink(getcwd().'/tests/Fut7/Data/SeasonTest.csv');
        }

        if (copy(getcwd().'/Fut7/Data/Season.csv', getcwd().'/tests/Fut7/Data/SeasonTest.csv')) {
            echo PHP_EOL.'[DeleteSeasonTests]SeasonTest.csv loaded'.PHP_EOL;
        }
        else {
            echo PHP_EOL.'[DeleteSeasonTests]Error loading SeasonTest.csv'.PHP_EOL;
        }
    }

    public static function tearDownAfterClass(): void
    {
        //unlink(getcwd().'/tests/Fut7/Data/SeasonTest.csv');
    }

    public function testDeleteSeasonNullUuid()
    {
        $this->expectException(SeasonUuidException::class);

        $repository = new CsvSeasonRepository(new CsvRepository(getcwd().'/tests/Fut7/Data/SeasonTest.csv'));

        $uuid = null;
        $deleteSeasonUseCase = new DeleteSeasonUseCase($repository);
        $response = $deleteSeasonUseCase->execute($uuid);

        $this->assertInstanceOf(DeleteSeasonResponse::class, $response);
    }

    public function testDeleteSeasonInvalidUuid()
    {
        $this->expectException(SeasonNotFoundException::class);

        $repository = new CsvSeasonRepository(new CsvRepository(getcwd().'/tests/Fut7/Data/SeasonTest.csv'));

        $uuid = new Uuid();
        $deleteSeasonUseCase = new DeleteSeasonUseCase($repository);
        $response = $deleteSeasonUseCase->execute($uuid->value());

        $this->assertInstanceOf(DeleteSeasonResponse::class, $response);
    }

    public function testDeleteSeasonCorrectUuid()
    {
        $repository = new CsvSeasonRepository(new CsvRepository(getcwd().'/tests/Fut7/Data/SeasonTest.csv'));

        $uuid = '47784ab8-0142-4193-8cdf-9c723ccb4b56';
        $deleteSeasonUseCase = new DeleteSeasonUseCase($repository);
        $response = $deleteSeasonUseCase->execute($uuid);

        $this->assertInstanceOf(DeleteSeasonResponse::class, $response);
    }
}