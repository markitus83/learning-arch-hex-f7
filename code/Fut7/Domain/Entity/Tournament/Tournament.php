<?php

namespace Fut7\Domain\Entity\Tournament;

class Tournament
{
    private string $id;
    private string $name;
    private string $season;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;

    private function __construct(
        $id,
        $name,
        $season
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->season = $season;
    }

    public static function createFromScratch($id, $name, $season): Tournament
    {
        $tournament = new self($id, $name, $season);
        $tournament->createdAt = $tournament->updatedAt = new \DateTime();

        return $tournament;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function season(): string
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