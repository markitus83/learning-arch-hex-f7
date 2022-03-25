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

    public function testDeleteSeasonInvalidUuid()
    {
        //$this->expectException(\TypeError::class);

        $repository = $this->getMockBuilder(SeasonRepositoryInterface::class)->getMock();
        $mockUuid = '19d0faf4-90dd-48a8-a09a-3f0aaa84475b';
        $repository->method('find')->willReturn($mockUuid);

        $uuid = '19d0faf4-90dd-48a8-a09a-3f0aaa84475b';
        $deleteSeasonUseCase = new DeleteSeasonUseCase($repository);
        $response = $deleteSeasonUseCase->execute($uuid);

        $this->assertInstanceOf(DeleteSeasonResponse::class, $response);
    }

    public function testDeleteSeasonCorrectUuid()
    {
    }
}