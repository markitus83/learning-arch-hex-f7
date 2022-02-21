<?php

namespace Fut7\Application\Tournament\CRUD\Create;

use Fut7\Domain\Contract\Repository\TournamentRepositoryInterface;
use Fut7\Domain\Entity\Tournament\Tournament;
use Fut7\Domain\Response\Tournament\CreateTournamentResponse;

class CreateTournamentUseCase
{
    private TournamentRepositoryInterface $tournamentRepository;

    public function __construct(TournamentRepositoryInterface $tournamentRepository)
    {
        $this->tournamentRepository = $tournamentRepository;
    }

    public function execute(
        CreateTournamentCommand $tournamentCommand
    ): CreateTournamentResponse{
        $object = Tournament::createFromScratch(
            $tournamentCommand->uuid(),
            $tournamentCommand->name(),
            $tournamentCommand->season()
        );

        $this->tournamentRepository->create($object);
        return new CreateTournamentResponse($object);
    }
}