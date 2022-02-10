<?php

namespace Fut7\Application\Tournament\CRUD\Find;

use Fut7\Domain\Contract\Repository\TournamentRepositoryInterface;
use Fut7\Domain\Entity\Tournament\Tournament;
use Fut7\Domain\Response\Tournament\FindTournamentResponse;

class FindTournamentUseCase
{
    private TournamentRepositoryInterface $tournamentRepository;

    public function __construct(TournamentRepositoryInterface $tournamentRepository)
    {
        $this->tournamentRepository = $tournamentRepository;
    }

    public function execute(FindTournamentQuery $query): FindTournamentResponse
    {
        $tournamentFind = $this->tournamentRepository->find($query->uuid());
        return new FindTournamentResponse($tournamentFind);
    }
}