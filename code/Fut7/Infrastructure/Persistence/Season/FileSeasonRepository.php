<?php namespace Fut7\Infrastructure\Persistence\Season;


use Fut7\Domain\Contract\Repository\SeasonRepositoryInterface;
use Fut7\Domain\Entity\Season\Season;

class FileSeasonRepository implements SeasonRepositoryInterface
{

    public function save(Season $season)
    {
        $fileOpen = fopen(
            "../../Data/Season.txt",
            "a+"
        );

        fputs($fileOpen, json_encode($season));
    }

    public function read()
    {
        // TODO: Implement read() method.
    }
}