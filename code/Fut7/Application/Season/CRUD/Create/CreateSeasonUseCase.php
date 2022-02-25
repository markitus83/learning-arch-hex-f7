<?php

namespace Fut7\Application\Season\CRUD\Create;

use Fut7\Domain\Contract\Repository\SeasonRepositoryInterface;
use Fut7\Domain\Entity\Season\Season;
use Fut7\Domain\Response\Season\CreateSeasonResponse;

class CreateSeasonUseCase
{
    private SeasonRepositoryInterface $seasonRepository;

    public function __construct(SeasonRepositoryInterface $seasonRepository)
    {
        $this->seasonRepository = $seasonRepository;
    }

    public function execute(CreateSeasonCommand $season): CreateSeasonResponse
    {
        $object = Season::createFromScratch(
            $season->uuid(),
            $season->name()
        );

        $this->seasonRepository->create($object);
        return new CreateSeasonResponse($object);
    }
}