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

    public function execute($id): DeleteSeasonResponse
    {
        $season = $this->seasonRepository->find($id);
        var_dump(['deleteSeasonUseCase::season'=>$season]);
        $this->seasonRepository->delete($season);
        return new DeleteSeasonResponse($season);
    }
}