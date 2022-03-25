<?php

namespace Fut7\Unit\Application\Season\CRUD\Delete;

use Fut7\Application\Season\CRUD\Delete\DeleteSeasonUseCase;
use Fut7\Domain\Contract\Repository\SeasonRepositoryInterface;
use Fut7\Domain\Response\Season\DeleteSeasonResponse;
use PHPUnit\Framework\TestCase;

class DeleteSeasonUseCaseTest extends TestCase
{
    public function testDeleteSeasonNullUuid()
    {
        $this->expectException(\TypeError::class);

        $repository = $this->getMockBuilder(SeasonRepositoryInterface::class)->getMock();

        $uuid = null;
        $deleteSeasonUseCase = new DeleteSeasonUseCase($repository);
        $response = $deleteSeasonUseCase->execute($uuid);

        $this->assertInstanceOf(DeleteSeasonResponse::class, $response);
    }

    public function testDeleteSeasonUuid()
    {
        $this->expectException(\TypeError::class);

        $repository = $this->getMockBuilder(SeasonRepositoryInterface::class)->getMock();

        $uuid = ;
        $deleteSeasonUseCase = new DeleteSeasonUseCase($repository);
        $response = $deleteSeasonUseCase->execute($uuid);

        $this->assertInstanceOf(DeleteSeasonResponse::class, $response);
    }
}