<?php

namespace Fut7\Application\Season\CRUD\Update;

use Fut7\Domain\Contract\Repository\SeasonRepositoryInterface;
use Fut7\Domain\Entity\Season\Season;
use Fut7\Domain\Response\Season\UpdateSeasonResponse;
use Fut7\Infrastructure\Shared\Utils\Uuid;

class UpdateSeasonUseCase
{
    private SeasonRepositoryInterface $seasonRepository;

    public function __construct(SeasonRepositoryInterface $seasonRepository)
    {
        $this->seasonRepository = $seasonRepository;
    }

    public function execute(UpdateSeasonCommand $season): UpdateSeasonResponse
    {
        $response = $this->seasonRepository->find($season->uuid());
        echo PHP_EOL.'Current name of Season '.$season->uuid().': '.$response->name().PHP_EOL;

        sleep(2);
        $uuid = Uuid::createFromString($season->uuid());
        $season = Season::createFromScratch($uuid, $season->name());
        echo PHP_EOL.'New name of Season '.$season->uuid().': '.$season->name().PHP_EOL;
        $this->seasonRepository->update($season);
        return new UpdateSeasonResponse($season);
    }
}