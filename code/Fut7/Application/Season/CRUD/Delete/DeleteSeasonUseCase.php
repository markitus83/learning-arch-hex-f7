<?php

namespace Fut7\Application\Season\CRUD\Delete;

use Fut7\Domain\Contract\Repository\SeasonRepositoryInterface;
use Fut7\Domain\Entity\Season\Season;
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
        if (null === $uuid) {
            throw new \TypeError("UUID must be a string!!");
        }
        $season = $this->seasonRepository->find($uuid);
        if (null == $season) {
            throw new \TypeError('Season with uuid '.$uuid.' not found. Skip delete action');
        }


        $this->seasonRepository->delete($season);
        return new DeleteSeasonResponse($season);
    }
}