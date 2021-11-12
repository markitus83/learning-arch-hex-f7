<?php

namespace Fut7\Application\Season\CRUD\Search;

use Fut7\Domain\Contract\Repository\SeasonRepositoryInterface;
use Fut7\Domain\Response\Season\SearchSeasonResponse;

class SearchSeasonUseCase
{
    private SeasonRepositoryInterface $seasonRepository;

    public function __construct(SeasonRepositoryInterface $seasonRepository)
    {
        $this->seasonRepository = $seasonRepository;
    }

    public function execute($criteria)
    {
        $seasons = $this->seasonRepository->search($criteria);
        return new SearchSeasonResponse($seasons);
    }
}