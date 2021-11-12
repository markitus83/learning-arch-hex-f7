<?php namespace F7\Domain\Entity;

use SharedKernel\...\Uuid;
use F7\Domain\Entity\Tournament;

class Team extends BaseEntity
{
    private Uuid $id;
    private string name;
    private \DateTime createdAt;
    private \DateTime updatedAt;

    private function __construct(
        Uuid $uuid,
        string $name,
        Tournament $tournament
    )
    {
        $this->id = $uuid;
        $this->name = $name;
    }

    public function name(): string
    {
        return $this->name;
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