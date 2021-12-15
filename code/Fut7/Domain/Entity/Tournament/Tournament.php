<?php

namespace Fut7\Domain\Entity\Tournament;

use Fut7\Domain\Entity\Season\Season;

class Tournament
{
    private string $id;
    private string $name;
    private Season $season;
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

    public static function createFromRepository($tournamentRepositoryData): Tournament
    {
        $season = Season::createFromRepository($tournamentRepositoryData[2]);
        $tournament = new self(
            $tournamentRepositoryData[0],
            $tournamentRepositoryData[1],
            $season
        );
        $tournament->createdAt = new \DateTime($tournamentRepositoryData[3]);
        $tournament->updatedAt = new \DateTime($tournamentRepositoryData[4]);

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