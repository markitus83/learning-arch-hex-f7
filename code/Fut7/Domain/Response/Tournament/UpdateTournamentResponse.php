<?php

namespace Fut7\Domain\Response\Tournament;

use Fut7\Domain\Contract\Response\DomainResponseInterface;
use Fut7\Domain\Entity\Tournament\Tournament;

class UpdateTournamentResponse implements DomainResponseInterface
{
    private Tournament $tournament;

    public function __construct(Tournament $season)
    {
        $this->tournament = $season;
    }

    public function season(): Tournament
    {
        return $this->tournament;
    }

    public function getResponse(): array
    {
        return [
            'message' => 'Tournament updated:',
            'data' => json_encode([
                $this->tournament->uuid(),
                $this->tournament->name(),
                $this->tournament->season(),
                $this->tournament->createdAt()->format('Y-m-d H:i:s'),
                $this->tournament->updatedAt()->format('Y-m-d H:i:s')
            ])
        ];
    }
}