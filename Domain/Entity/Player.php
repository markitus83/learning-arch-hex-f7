<?php namespace F7\Domain\Entity;

use SharedKernel\...\Uuid;
use F7\Domain\Entity\Team;

class Player extends BaseEntity
{
    private Uuid $id;
    private string name;
    private Team $team;
    ## dorsal
    private \DateTime createdAt;
    private \DateTime updatedAt;

    private function __construct(
        Uuid $uuid,
        string $name,
        Team $team
    )
    {
        $this->id = $uuid;
        $this->name = $name;
        $this->team = $team;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function team(): Team
    {
        return $this->team;
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