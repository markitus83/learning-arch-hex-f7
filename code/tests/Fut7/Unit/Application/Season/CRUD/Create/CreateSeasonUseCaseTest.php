<?php

namespace Fut7\Unit\Application\Season\CRUD\Create;

use Fut7\Application\Season\CRUD\Create\CreateSeasonCommand;
use Fut7\Application\Season\CRUD\Create\CreateSeasonUseCase;
use Fut7\Domain\Contract\Repository\SeasonRepositoryInterface;
use Fut7\Domain\Response\Season\CreateSeasonResponse;
use Fut7\Infrastructure\Shared\Utils\Uuid;
use PHPUnit\Framework\TestCase;

class CreateSeasonUseCaseTest extends TestCase
{
    public function testCreateSeasonUseCaseErrorUuid()
    {
        $this->expectException(\TypeError::class);

        $repository = $this->getMockBuilder(SeasonRepositoryInterface::class)->getMock();

        $uuid = null;
        $name = 'mock-season-name';
        $seasonDTO = new CreateSeasonCommand($uuid, $name);

        $createSeasonUseCase = new CreateSeasonUseCase($repository);
        $response = $createSeasonUseCase->execute($seasonDTO);

        $this->assertInstanceOf(CreateSeasonResponse::class, $response);
    }

    public function testCreateSeasonUseCaseErrorName()
    {
        $this->expectException(\TypeError::class);

        $repository = $this->getMockBuilder(SeasonRepositoryInterface::class)->getMock();

        $uuid = new Uuid();
        $name = null;
        $seasonDTO = new CreateSeasonCommand($uuid, $name);

        $createSeasonUseCase = new CreateSeasonUseCase($repository);
        $response = $createSeasonUseCase->execute($seasonDTO);

        $this->assertInstanceOf(CreateSeasonResponse::class, $response);
    }

    public function testCreateSeasonUseCase()
    {
        $repository = $this->getMockBuilder(SeasonRepositoryInterface::class)->getMock();
        $seasonDTO = $this->getMockBuilder(CreateSeasonCommand::class)
            ->disableOriginalConstructor()
            ->getMock();

//        $uuid = new Uuid();
//        $name = 'test';
//        $seasonDTO = new CreateSeasonCommand($uuid, $name);

        $createSeasonUseCase = new CreateSeasonUseCase($repository);
        $response = $createSeasonUseCase->execute($seasonDTO);

        $this->assertInstanceOf(CreateSeasonResponse::class, $response);
    }
}