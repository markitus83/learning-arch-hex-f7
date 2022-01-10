<?php

namespace Fut7\Application\Tournament\CRUD\Delete;

use Fut7\Domain\Contract\Repository\TournamentRepositoryInterface;
use Fut7\Domain\Entity\Tournament\Tournament;
use Fut7\Domain\Response\Tournament\DeleteTournamentResponse;

class DeleteTournamentUseCase
{
    private TournamentRepositoryInterface $tournamentRepository;

    public function __construct(
        TournamentRepositoryInterface $tournamentRepository
    ) {
        $this->tournamentRepository = $tournamentRepository;
    }

    public function execute($id): DeleteTournamentResponse
    {
        // TODO: xxRepository find puede devolver obj X, asi ahorramos el createXXX
        // TODO: esto provoca acoplamiento a Infraestructura
        $tournament = $this->tournamentRepository->find($id);
        $tournament = Tournament::createFromRepository($tournament);

        $this->tournamentRepository->delete($tournament);
        return new DeleteTournamentResponse($tournament);
    }
}