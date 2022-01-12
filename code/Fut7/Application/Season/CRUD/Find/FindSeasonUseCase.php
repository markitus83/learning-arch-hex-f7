<?php namespace Fut7\Application\Season\CRUD\Find;


use Fut7\Domain\Contract\Repository\SeasonRepositoryInterface;
use Fut7\Domain\Entity\Season\Season;
use Fut7\Domain\Response\Season\FindSeasonResponse;

class FindSeasonUseCase
{
    private SeasonRepositoryInterface $seasonRepository;

    public function __construct(SeasonRepositoryInterface $seasonRepository)
    {
        $this->seasonRepository = $seasonRepository;
    }

    public function execute(FindSeasonQuery $query): FindSeasonResponse
    {
        $seasonFind = $this->seasonRepository->find($query->id());
        return new FindSeasonResponse($seasonFind);
    }
}