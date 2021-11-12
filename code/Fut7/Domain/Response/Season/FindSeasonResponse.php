<?php namespace Fut7\Domain\Response\Season;

use Fut7\Domain\Contract\Response\DomainResponseInterface;
use Fut7\Domain\Entity\Season\Season;

class FindSeasonResponse implements DomainResponseInterface
{
    private Season $season;

    public function __construct(Season $season)
    {
        $this->season = $season;
    }

    public function season(): Season
    {
        return $this->season;
    }

    public function getResponse(): string
    {
        return PHP_EOL.'season found >> Info: '.
            json_encode(
                [
                    $this->season->id(),
                    $this->season->name(),
                    $this->season->createdAt()->format('Y-m-d H:i:s'),
                    $this->season->updatedAt()->format('Y-m-d H:i:s'),
                ]
            );
    }
}