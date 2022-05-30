<?php

namespace Fut7\Unit\Application\Season\CRUD\Delete;

use Fut7\Application\Season\CRUD\Delete\DeleteSeasonUseCase;

use Fut7\Domain\Contract\Repository\SeasonRepositoryInterface;
use Fut7\Domain\Entity\Season\Season;
use Fut7\Domain\Exception\Season\SeasonNotFoundException;
use Fut7\Domain\Exception\Season\SeasonUuidException;
use Fut7\Domain\Response\Season\DeleteSeasonResponse;
use Fut7\Domain\ValueObject\SeasonName;
use Fut7\Domain\ValueObject\SeasonUuid;
use Fut7\Infrastructure\Shared\Utils\Uuid;
use PHPUnit\Framework\TestCase;

class DeleteSeasonUseCaseTest extends TestCase
{
    public function testDeleteSeasonNullUuid()
    {
        $this->expectException(SeasonUuidException::class);

        $repository = $this->getMockBuilder(SeasonRepositoryInterface::class)->getMock();

        $uuid = null;
        $deleteSeasonUseCase = new DeleteSeasonUseCase($repository);
        $response = $deleteSeasonUseCase->execute($uuid);

        $this->assertInstanceOf(DeleteSeasonResponse::class, $response);
    }

    public function testDeleteSeasonNotExistUuid()
    {
        $this->expectException(SeasonNotFoundException::class);

        $repository = $this->getMockBuilder(SeasonRepositoryInterface::class)->getMock();
        $repository->method('find')->willThrowException(new SeasonNotFoundException());

        $uuid = '19d0faf4-90dd-48a8-a09a-3f0aaa84475b';
        $deleteSeasonUseCase = new DeleteSeasonUseCase($repository);
        $response = $deleteSeasonUseCase->execute($uuid);

        $this->assertInstanceOf(DeleteSeasonResponse::class, $response);
    }

    public function testDeleteSeasonExistUuid()
    {
        $mockUuid = Uuid::createFromString('19d0faf4-90dd-48a8-a09a-3f0aaa84475b');
        $mockName = 'mock-season';
        $mockSeasonUuid = new SeasonUuid($mockUuid);
        $mockSeasonName = new SeasonName($mockName);
        $mockSeason = Season::createFromScratch($mockSeasonUuid, $mockSeasonName);

        $repository = $this->getMockBuilder(SeasonRepositoryInterface::class)->getMock();
        $repository->method('find')->willReturn($mockSeason);

        $uuid = '19d0faf4-90dd-48a8-a09a-3f0aaa84475b';
        $deleteSeasonUseCase = new DeleteSeasonUseCase($repository);
        $response = $deleteSeasonUseCase->execute($uuid);

        $this->assertInstanceOf(DeleteSeasonResponse::class, $response);
    }


}