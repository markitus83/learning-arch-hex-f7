<?php

namespace Fut7\Integration\Application\Season\CRUD\Create;

use Fut7\Application\Season\CRUD\Create\CreateSeasonCommand;
use Fut7\Application\Season\CRUD\Create\CreateSeasonUseCase;
use Fut7\Domain\Exception\Season\SeasonNameException;
use Fut7\Domain\Exception\Season\SeasonUuidException;
use Fut7\Domain\Response\Season\CreateSeasonResponse;
use Fut7\Infrastructure\Persistence\Season\CsvSeasonRepository;
use Fut7\Infrastructure\Persistence\Shared\CsvRepository;
use Fut7\Infrastructure\Shared\Utils\Uuid;
use PHPUnit\Framework\TestCase;

class CreateSeasonUseCaseTest extends TestCase
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
            echo PHP_EOL.'[CreateSeasonTests]SeasonTest.csv loaded and ready to run the tests'.PHP_EOL;
        }
        else {
            echo PHP_EOL.'[CreateSeasonTests]Error loading SeasonTest.csv'.PHP_EOL;
        }
    }

    public static function tearDownAfterClass(): void
    {
        //unlink(getcwd().'/tests/Fut7/Data/SeasonTest.csv');
    }

    /**
     * @throws SeasonNameException
     * @throws SeasonUuidException
     */
    public function testCreateSeasonUseCaseNullUuid()
    {
        $this->expectException(SeasonUuidException::class);

        $repository = new CsvSeasonRepository(new CsvRepository(getcwd().'/tests/Fut7/Data/SeasonTest.csv'));

        $uuid = null;
        $name = 'mock-season-name';
        $seasonDTO = new CreateSeasonCommand($uuid, $name);

        $createSeasonUseCase = new CreateSeasonUseCase($repository);
        $response = $createSeasonUseCase->execute($seasonDTO);

        $this->assertInstanceOf(CreateSeasonResponse::class, $response);
    }

    /**
     * @throws SeasonNameException
     * @throws SeasonUuidException
     */
    public function testCreateSeasonUseCaseNullName()
    {
        $this->expectException(SeasonNameException::class);

        $repository = new CsvSeasonRepository(new CsvRepository(getcwd().'/tests/Fut7/Data/SeasonTest.csv'));

        $uuid = new Uuid();
        $name = null;
        $seasonDTO = new CreateSeasonCommand($uuid, $name);

        $createSeasonUseCase = new CreateSeasonUseCase($repository);
        $response = $createSeasonUseCase->execute($seasonDTO);

        $this->assertInstanceOf(CreateSeasonResponse::class, $response);
    }

    /**
     * @throws SeasonNameException
     * @throws SeasonUuidException
     */
    public function testCreateSeasonUseCaseEmptyName()
    {
        $this->expectException(SeasonNameException::class);

        $repository = new CsvSeasonRepository(new CsvRepository(getcwd().'/tests/Fut7/Data/SeasonTest.csv'));

        $uuid = new Uuid();
        $name = '';
        $seasonDTO = new CreateSeasonCommand($uuid, $name);

        $createSeasonUseCase = new CreateSeasonUseCase($repository);
        $response = $createSeasonUseCase->execute($seasonDTO);

        $this->assertInstanceOf(CreateSeasonResponse::class, $response);
    }

    /**
     * @throws SeasonNameException
     * @throws SeasonUuidException
     */
    public function testCreateSeasonUseCaseCorrectData()
    {
        $repository = new CsvSeasonRepository(new CsvRepository(getcwd().'/tests/Fut7/Data/SeasonTest.csv'));

        $uuid = new Uuid();
        $name = 'integration test';
        $seasonDTO = new CreateSeasonCommand($uuid, $name);

        $createSeasonUseCase = new CreateSeasonUseCase($repository);
        $response = $createSeasonUseCase->execute($seasonDTO);

        $this->assertInstanceOf(CreateSeasonResponse::class, $response);
    }
}