<?php

namespace Fut7\Application\Season\CRUD\Update;

use Fut7\Domain\Contract\Repository\SeasonRepositoryInterface;
use Fut7\Domain\Response\Season\UpdateSeasonResponse;

class UpdateSeasonUseCase
{
    private SeasonRepositoryInterface $seasonRepository;

    public function __construct(SeasonRepositoryInterface $seasonRepository)
    {
        $this->seasonRepository = $seasonRepository;
    }

    public function execute($id)
    {
        $season = $this->seasonRepository->update($id);
        return new UpdateSeasonResponse($season);
    }
}