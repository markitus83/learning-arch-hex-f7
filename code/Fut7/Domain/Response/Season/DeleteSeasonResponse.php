<?php namespace Fut7\Domain\Response\Season;

use Fut7\Domain\Contract\Response\DomainResponseInterface;
use Fut7\Domain\Entity\Season\Season;

class DeleteSeasonResponse implements DomainResponseInterface
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
        return 'season deleted';
    }
}