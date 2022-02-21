<?php

namespace Fut7\Application\Season\CRUD\Delete;

use Fut7\Domain\Contract\Repository\SeasonRepositoryInterface;
use Fut7\Domain\Response\Season\DeleteSeasonResponse;

class DeleteSeasonUseCase
{
    private SeasonRepositoryInterface $seasonRepository;

    public function __construct(SeasonRepositoryInterface $seasonRepository)
    {
        $this->seasonRepository = $seasonRepository;
    }

    /**
     * @throws \Exception
     */
    public function execute($uuid): DeleteSeasonResponse
    {
        $season = $this->seasonRepository->find($uuid);
        $this->seasonRepository->delete($season);
        return new DeleteSeasonResponse($season);
    }
}