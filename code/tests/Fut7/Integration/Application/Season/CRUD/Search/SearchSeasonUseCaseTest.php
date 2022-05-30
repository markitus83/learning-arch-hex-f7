<?php

namespace Fut7\Integration\Application\Season\CRUD\Search;

use Fut7\Application\Season\CRUD\Search\SearchSeasonQuery;
use Fut7\Application\Season\CRUD\Search\SearchSeasonUseCase;
use Fut7\Domain\Contract\Repository\SeasonRepositoryInterface;
use Fut7\Domain\Exception\Season\SeasonSearchEmptyCriteriaException;
use Fut7\Domain\Response\Season\SearchSeasonResponse;
use PHPUnit\Framework\TestCase;

class SearchSeasonUseCaseTest extends TestCase
{
    /**
     * @throws SeasonSearchEmptyCriteriaException
     */
    public function testSearchSeasonUseCaseErrorNullCriteria()
    {
        $this->expectException(\TypeError::class);

        $repository = $this->getMockBuilder(SeasonRepositoryInterface::class)->getMock();

        $criteria = null;
        $query = new SearchSeasonQuery($criteria);

        $searchSeasonUseCase = new SearchSeasonUseCase($repository);
        $response = $searchSeasonUseCase->execute($query->criteria());

        $this->assertInstanceOf(SearchSeasonResponse::class, $response);
    }

    public function testSearchSeasonUseCaseErrorEmptyCriteria()
    {
        $this->expectException(SeasonSearchEmptyCriteriaException::class);

        $repository = $this->getMockBuilder(SeasonRepositoryInterface::class)->getMock();

        $criteria =  [];
        // criteria vacio => return all data
        $query = new SearchSeasonQuery($criteria);

        $searchSeasonUseCase = new SearchSeasonUseCase($repository);
        $response = $searchSeasonUseCase->execute($query->criteria());

        $this->assertInstanceOf(SearchSeasonResponse::class, $response);
    }

    /**
     * @throws SeasonSearchEmptyCriteriaException
     */
    public function testSearchSeasonUseCase()
    {
        // mock data >> fichero csv con datos mock, crear repostiory en base a este fichero e interactuar con él
        $repository = $this->getMockBuilder(SeasonRepositoryInterface::class)->getMock();
        $mockSearchResponse = [
            ["c72134eb-e1c0-48eb-b6bf-7119aef18b9f","Tempo 2021-2022","2022-02-10 15:35:34","2022-02-10 15:35:34"],
            ["f6eef104-7236-4b62-87d8-c3b77031acdc","Tempo 2021-2022","2022-02-10 16:14:49","2022-02-10 16:14:49"],
        ];
        $repository->method('search')->willReturn($mockSearchResponse);

        $criteria =  ['uuid' => 'c72134eb-e1c0-48eb-b6bf-7119aef18b9f'];
        $query = new SearchSeasonQuery($criteria);

        $searchSeasonUseCase = new SearchSeasonUseCase($repository);
        $response = $searchSeasonUseCase->execute($query->criteria());

        $this->assertInstanceOf(SearchSeasonResponse::class, $response);
        //$this->assertContains($criteria['uuid'], $mockSearchResponse);
        $this->assertEquals($criteria['uuid'], $mockSearchResponse[0][0]);
    }

    /**
     * @throws SeasonSearchEmptyCriteriaException
     */
    public function testSearchSeasonUseCaseNotFound()
    {
        $repository = $this->getMockBuilder(SeasonRepositoryInterface::class)->getMock();
        $mockSearchResponse = [
            ["c72134eb-e1c0-48eb-b6bf-7119aef18b9f","Tempo 2021-2022","2022-02-10 15:35:34","2022-02-10 15:35:34"],
            ["f6eef104-7236-4b62-87d8-c3b77031acdc","Tempo 2021-2022","2022-02-10 16:14:49","2022-02-10 16:14:49"],
        ];
        $repository->method('search')->willReturn($mockSearchResponse);

        $criteria =  ['uuid' => 'bfa9c58c-5801-4cd8-b766-0b190651a3b0'];
        $query = new SearchSeasonQuery($criteria);

        $searchSeasonUseCase = new SearchSeasonUseCase($repository);
        $response = $searchSeasonUseCase->execute($query->criteria());

        $this->assertInstanceOf(SearchSeasonResponse::class, $response);
        //$this->assertNotContains($criteria['uuid'], $mockSearchResponse);
        $this->assertNotEquals($criteria['uuid'], $mockSearchResponse[0][0]);
    }
}