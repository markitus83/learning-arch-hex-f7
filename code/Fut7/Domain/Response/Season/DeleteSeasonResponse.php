<?php

namespace Fut7\Domain\Response\Season;

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

    public function getResponse(): array
    {
        return [
            'message' => 'Season deleted with ID '.$this->season->uuid(),
            'data' => json_encode([
                $this->season->uuid(),
                $this->season->name(),
                $this->season->createdAt()->format('Y-m-d H:i:s'),
                $this->season->updatedAt()->format('Y-m-d H:i:s')
            ])
        ];
    }
}