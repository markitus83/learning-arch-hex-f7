<?php

namespace Fut7\Application\Tournament\CRUD\Search;

use Fut7\Domain\Contract\Repository\TournamentRepositoryInterface;
use Fut7\Domain\Response\Tournament\SearchTournamentResponse;

class SearchTournamentUseCase
{
    private TournamentRepositoryInterface $tournamentRepository;

    public function __construct(TournamentRepositoryInterface $tournamentRepository)
    {
        $this->tournamentRepository = $tournamentRepository;
    }

    public function execute($criteria): SearchTournamentResponse
    {
        $tournament = $this->tournamentRepository->search($criteria);
        return new SearchTournamentResponse($tournament);
    }
}