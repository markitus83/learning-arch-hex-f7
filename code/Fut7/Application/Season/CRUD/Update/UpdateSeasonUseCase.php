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
        echo PHP_EOL.'Current name of Season '.$season->id().': '.$response[1].PHP_EOL;

        sleep(2);
        $season = Season::createFromScratch($season->id(), $season->name());
        echo PHP_EOL.'New name of Season '.$season->id().': '.$season->name().PHP_EOL;
        $this->seasonRepository->update($season);
        return new UpdateSeasonResponse($season);
    }
}