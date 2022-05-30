<?php

namespace Fut7\Integration\Application\Season\CRUD\Find;

use Fut7\Application\Season\CRUD\Find\FindSeasonQuery;
use Fut7\Application\Season\CRUD\Find\FindSeasonUseCase;
use Fut7\Domain\Contract\Repository\SeasonRepositoryInterface;
use Fut7\Domain\Response\Season\FindSeasonResponse;
use PHPUnit\Framework\TestCase;

class FindSeasonUseCaseTest extends TestCase
{
    public function testFindSeasonUseCaseErrorUuid()
    {
        $this->expectException(\TypeError::class);

        $repository = $this->getMockBuilder(SeasonRepositoryInterface::class)->getMock();

        $uuid = null;
        $query = new FindSeasonQuery($uuid);

        $findSeasonUseCase = new FindSeasonUseCase($repository);
        $response = $findSeasonUseCase->execute($query);

        $this->assertInstanceOf(FindSeasonResponse::class, $response);
    }

    public function testFindSeasonUseCase()
    {
        $this->expectException(\TypeError::class);

        $repository = $this->getMockBuilder(SeasonRepositoryInterface::class)->getMock();

        $uuid = 'c72134eb-e1c0-48eb-b6bf-7119aef18b9f';
        $query = new FindSeasonQuery($uuid);

        $findSeasonUseCase = new FindSeasonUseCase($repository);
        $response = $findSeasonUseCase->execute($query);

        $this->assertInstanceOf(FindSeasonResponse::class, $response);
    }
}