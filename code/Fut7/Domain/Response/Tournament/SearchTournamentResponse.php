<?php namespace Fut7\Domain\Response\Tournament;

use Fut7\Domain\Contract\Response\DomainResponseInterface;

class SearchTournamentResponse implements DomainResponseInterface
{
    private array $tournament;

    public function __construct($tournament)
    {
        $this->tournament = $tournament;
    }

    public function seasons()
    {
        return $this->tournament;
    }

    public function getResponse(): array
    {
        return [
            'message' => 'Tournament found after search:',
            'data' => $this->seasons()
        ];
    }
}