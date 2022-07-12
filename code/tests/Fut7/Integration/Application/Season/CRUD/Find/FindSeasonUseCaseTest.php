<?php

namespace Fut7\Integration\Application\Season\CRUD\Find;

use Fut7\Application\Season\CRUD\Find\FindSeasonQuery;
use Fut7\Application\Season\CRUD\Find\FindSeasonUseCase;
use Fut7\Domain\Contract\Repository\SeasonRepositoryInterface;
use Fut7\Domain\Exception\Season\SeasonNotFoundException;
use Fut7\Domain\Exception\Season\SeasonUuidException;
use Fut7\Domain\Response\Season\FindSeasonResponse;
use Fut7\Infrastructure\Persistence\Season\CsvSeasonRepository;
use Fut7\Infrastructure\Persistence\Shared\CsvRepository;
use Fut7\Infrastructure\Shared\Utils\Uuid;
use PHPUnit\Framework\TestCase;

class FindSeasonUseCaseTest extends TestCase
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
            echo PHP_EOL.'[FindSeasonTests]SeasonTest.csv loaded and ready to run the tests'.PHP_EOL;
        }
        else {
            echo PHP_EOL.'[FindSeasonTests]Error loading SeasonTest.csv'.PHP_EOL;
        }
    }

    public function testFindSeasonUseCaseNullUuid()
    {
        $this->expectException(SeasonUuidException::class);

        $repository = new CsvSeasonRepository(new CsvRepository(getcwd().'/tests/Fut7/Data/SeasonTest.csv'));

        $uuid = null;
        $query = new FindSeasonQuery($uuid);

        $findSeasonUseCase = new FindSeasonUseCase($repository);
        $response = $findSeasonUseCase->execute($query);

        $this->assertInstanceOf(FindSeasonResponse::class, $response);
    }

    public function testFindSeasonUseCaseNotFoundUuid()
    {
        $this->expectException(SeasonNotFoundException::class);
        $repository = new CsvSeasonRepository(new CsvRepository(getcwd().'/tests/Fut7/Data/SeasonTest.csv'));

        $uuid = new Uuid();
        $query = new FindSeasonQuery($uuid->value());

        $findSeasonUseCase = new FindSeasonUseCase($repository);
        $response = $findSeasonUseCase->execute($query);

        $this->assertInstanceOf(FindSeasonResponse::class, $response);
    }

    public function testFindSeasonUseCaseCorrectUuid()
    {
        $repository = new CsvSeasonRepository(new CsvRepository(getcwd().'/tests/Fut7/Data/SeasonTest.csv'));

        $uuid = 'c72134eb-e1c0-48eb-b6bf-7119aef18b9f';
        $query = new FindSeasonQuery($uuid);

        $findSeasonUseCase = new FindSeasonUseCase($repository);
        $response = $findSeasonUseCase->execute($query);

        $this->assertInstanceOf(FindSeasonResponse::class, $response);
    }
}