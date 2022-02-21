<?php

namespace Fut7\Application\Tournament\CRUD\Delete;

use Fut7\Domain\Contract\Repository\TournamentRepositoryInterface;
use Fut7\Domain\Response\Tournament\DeleteTournamentResponse;

class DeleteTournamentUseCase
{
    private TournamentRepositoryInterface $tournamentRepository;

    public function __construct(
        TournamentRepositoryInterface $tournamentRepository
    ) {
        $this->tournamentRepository = $tournamentRepository;
    }

    public function execute($uuid): DeleteTournamentResponse
    {
        $tournament = $this->tournamentRepository->find($uuid);

        $this->tournamentRepository->delete($tournament);
        return new DeleteTournamentResponse($tournament);
    }
}