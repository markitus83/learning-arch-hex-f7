<?php

namespace Fut7\Application\Tournament\CRUD\Delete;

use Fut7\Application\Season\CRUD\Find\FindSeasonQuery;
use Fut7\Application\Season\CRUD\Find\FindSeasonUseCase;
use Fut7\Domain\Contract\Repository\SeasonRepositoryInterface;
use Fut7\Domain\Contract\Repository\TournamentRepositoryInterface;
use Fut7\Domain\Entity\Tournament\Tournament;
use Fut7\Domain\Response\Tournament\DeleteTournamentResponse;

class DeleteTournamentUseCase
{
    private TournamentRepositoryInterface $tournamentRepository;
    private SeasonRepositoryInterface $seasonRepository;

    public function __construct(
        TournamentRepositoryInterface $tournamentRepository,
        SeasonRepositoryInterface $seasonRepository
    ) {
        $this->tournamentRepository = $tournamentRepository;
        $this->seasonRepository = $seasonRepository;
    }

    public function execute($id): DeleteTournamentResponse
    {
        $tournament = $this->tournamentRepository->find($id);

        // TODO: es bien llamar a otro UseCase? (si) comparten capa / (no) rompe SRP
        // TODO: implica añadir al UseCase el SeasonRepository para usar FindSeasonUseCase ¿?
        $seasonQuery = new FindSeasonQuery($tournament[2]);
        $seasonFindUseCase = new FindSeasonUseCase($this->seasonRepository);
        $season = $seasonFindUseCase->execute($seasonQuery);

        $tournament[2] = json_decode($season->getResponse()['data']);

        $tournament = Tournament::createFromRepository($tournament);
        $this->tournamentRepository->delete($tournament);
        return new DeleteTournamentResponse($tournament);
    }
}