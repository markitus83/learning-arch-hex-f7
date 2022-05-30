<?php

namespace Fut7\Unit\Application\Season\CRUD\Find;

use Fut7\Application\Season\CRUD\Find\FindSeasonQuery;
use Fut7\Application\Season\CRUD\Find\FindSeasonUseCase;
use Fut7\Domain\Contract\Repository\SeasonRepositoryInterface;
use Fut7\Domain\Entity\Season\Season;
use Fut7\Domain\Exception\Season\SeasonNotFoundException;
use Fut7\Domain\Exception\Season\SeasonUuidException;
use Fut7\Domain\Response\Season\FindSeasonResponse;
use Fut7\Domain\ValueObject\SeasonName;
use Fut7\Domain\ValueObject\SeasonUuid;
use Fut7\Infrastructure\Shared\Utils\Uuid;
use PHPUnit\Framework\TestCase;

class FindSeasonUseCaseTest extends TestCase
{
    public function testFindSeasonNullUuid()
    {
        $this->expectException(SeasonUuidException::class);

        $repository = $this->getMockBuilder(SeasonRepositoryInterface::class)->getMock();

        $uuid = null;
        $query = new FindSeasonQuery($uuid);

        $findSeasonUseCase = new FindSeasonUseCase($repository);
        $response = $findSeasonUseCase->execute($query);

        $this->assertInstanceOf(FindSeasonResponse::class, $response);
    }

    public function testFindSeasonNoExistUuid()
    {
        $this->expectException(SeasonNotFoundException::class);

        $repository = $this->getMockBuilder(SeasonRepositoryInterface::class)->getMock();
        $repository->method('find')->willThrowException(new SeasonNotFoundException());

        $uuid = new Uuid();
        $query = new FindSeasonQuery($uuid->value());

        $findSeasonUseCase = new FindSeasonUseCase($repository);
        $response = $findSeasonUseCase->execute($query);

        $this->assertInstanceOf(FindSeasonResponse::class, $response);
    }

    public function testFindSeasonExistUuid()
    {
        $mockUuid = Uuid::createFromString('19d0faf4-90dd-48a8-a09a-3f0aaa84475b');
        $mockName = 'mock-season';
        $mockSeasonUuid = new SeasonUuid($mockUuid);
        $mockSeasonName = new SeasonName($mockName);
        $mockSeason = Season::createFromScratch($mockSeasonUuid, $mockSeasonName);

        $repository = $this->getMockBuilder(SeasonRepositoryInterface::class)->getMock();
        $repository->method('find')->willReturn($mockSeason);

        $uuid = '19d0faf4-90dd-48a8-a09a-3f0aaa84475b';
        $query = new FindSeasonQuery($uuid);

        $findSeasonUseCase = new FindSeasonUseCase($repository);
        $response = $findSeasonUseCase->execute($query);

        $this->assertInstanceOf(FindSeasonResponse::class, $response);
        $this->assertEquals($uuid, $response->season()->uuid());
    }
}