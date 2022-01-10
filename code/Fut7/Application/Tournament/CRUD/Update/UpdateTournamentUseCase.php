<?php

namespace Fut7\Application\Tournament\CRUD\Update;

use Fut7\Domain\Contract\Repository\TournamentRepositoryInterface;
use Fut7\Domain\Entity\Tournament\Tournament;
use Fut7\Domain\Response\Tournament\UpdateTournamentResponse;

class UpdateTournamentUseCase
{
    private TournamentRepositoryInterface $tournamentRepository;

    public function __construct(TournamentRepositoryInterface $tournamentRepository)
    {
        $this->tournamentRepository = $tournamentRepository;
    }

    public function execute(UpdateTournamentCommand $tournament): UpdateTournamentResponse
    {
        $response = $this->tournamentRepository->find($tournament->id());
        echo PHP_EOL.'Current name of Tournament '.$tournament->id().': '.$response[1].PHP_EOL;

        sleep(2);
        $tournament = Tournament::createFromScratch($tournament->id(), $tournament->name(), $tournament->season());
        echo PHP_EOL.'New name of Tournament '.$tournament->id().': '.$tournament->name().PHP_EOL;
        $this->tournamentRepository->update($tournament);
        return new UpdateTournamentResponse($tournament);
    }
}