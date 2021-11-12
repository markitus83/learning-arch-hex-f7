<?php namespace F7\Domain\Entity;

use SharedKernel\...\Uuid;
use F7\Domain\Entity\Team;

class Match extends BaseEntity
{
    private Uuid $id;
    private string name;
    private Team $localTeam;
    private Team $visitingTeam;
    ## scoreLocalTeam
    ## scoreVisitingTeam
    ## string matchResult: localWin, visitingWin, draw >> VO matchResult(scoreLocal, scoreVisiting) => return matchResult value 
    private \DateTime createdAt;
    private \DateTime updatedAt;

    private function __construct(
        Uuid $uuid,
        string $name,
        Team $localTeam
        Team $visitingTeam
    )
    {
        $this->id = $uuid;
        $this->name = $name;
        $this->localTeam = $localTeam;
        $this->visitingTeam = $visitingTeam;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function localTeam(): Team
    {
        return $this->localTeam;
    }

    public function visitingTeam(): Team
    {
        return $this->visitingTeam;
    }

    public function createdAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function updatedAt(): \DateTime
    {
        return $this->updatedAt;
    }
}