<?php

namespace Fut7\Application\Season\CRUD\Update;

use Fut7\Domain\Contract\Repository\SeasonRepositoryInterface;
use Fut7\Domain\Entity\Season\Season;
use Fut7\Domain\Response\Season\UpdateSeasonResponse;

class UpdateSeasonUseCase
{
    private SeasonRepositoryInterface $seasonRepository;

    public function __construct(SeasonRepositoryInterface $seasonRepository)
    {
        $this->seasonRepository = $seasonRepository;
    }

    public function execute(UpdateSeasonCommand $season): UpdateSeasonResponse
    {
        $response = $this->seasonRepository->find($season->id());
        $season = Season::createFromScratch($season->id(), $season->name());
        $this->seasonRepository->update($season);
        return new UpdateSeasonResponse($season);
    }
}