<?php namespace Fut7\Domain\Response\Tournament;

use Fut7\Domain\Contract\Response\DomainResponseInterface;
use Fut7\Domain\Entity\Tournament\Tournament;


class DeleteTournamentResponse implements DomainResponseInterface
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
            'message' => 'Tournament deleted with ID '.$this->tournament->id(),
            'data' => json_encode([
                $this->tournament->id(),
                $this->tournament->name(),
                $this->tournament->season()->id(),
                $this->tournament->createdAt()->format('Y-m-d H:i:s'),
                $this->tournament->updatedAt()->format('Y-m-d H:i:s')
            ])
        ];
    }
}