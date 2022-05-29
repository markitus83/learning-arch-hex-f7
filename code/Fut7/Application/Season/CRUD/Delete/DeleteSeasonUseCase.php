<?php

namespace Fut7\Application\Season\CRUD\Delete;

use Fut7\Domain\Contract\Repository\SeasonRepositoryInterface;
use Fut7\Domain\Exception\Season\SeasonNotFoundException;
use Fut7\Domain\Exception\Season\SeasonUuidException;
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
            throw new SeasonUuidException('Season uuid not must be null or empty');
        }
        $season = $this->seasonRepository->find($uuid);
        if (null == $season) {
            throw new SeasonNotFoundException('Season with uuid '.$uuid.' not found. Skip delete action');
        }


        $this->seasonRepository->delete($season);
        return new DeleteSeasonResponse($season);
    }
}