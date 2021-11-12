<?php namespace F7\Domain\Entity;

use SharedKernel\...\Uuid;
use F7\Domain\Entity\Season;

class Tournament extends BaseEntity
{
    private Uuid $id;
    private string name;
    private Season $season;
    private \DateTime createdAt;
    private \DateTime updatedAt;

    private function __construct(
        Uuid $uuid,
        string $name,
        Season $season
    )
    {
        $this->id = $uuid;
        $this->name = $name;
        $this->season = $season;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function season(): Season
    {
        return $this->season;
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