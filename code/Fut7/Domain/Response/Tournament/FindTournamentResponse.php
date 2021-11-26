<?php namespace Fut7\Domain\Response\Tournament;

use Fut7\Domain\Contract\Response\DomainResponseInterface;
use Fut7\Domain\Entity\Season\Season;
use Fut7\Domain\Entity\Tournament\Tournament;

class FindTournamentResponse implements DomainResponseInterface
{
    private Tournament $tournament;

    public function __construct(Tournament $tournament)
    {
        $this->tournament = $tournament;
    }

    public function season(): Tournament
    {
        return $this->tournament;
    }

    public function getResponse(): array
    {
        return [
            'message' => 'Tournament found with ID '.$this->tournament->id(),
            'data' => json_encode([
                $this->tournament->id(),
                $this->tournament->name(),
                $this->tournament->season(),
                $this->tournament->createdAt()->format('Y-m-d H:i:s'),
                $this->tournament->updatedAt()->format('Y-m-d H:i:s')
            ])
        ];
    }
}