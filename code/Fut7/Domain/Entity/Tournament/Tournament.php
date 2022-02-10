<?php

namespace Fut7\Domain\Entity\Tournament;

use Fut7\Domain\Entity\Season\Season;
use Fut7\Infrastructure\Shared\Utils\Uuid;

class Tournament
{
    private Uuid $uuid;
    private string $name;
    private Season $season;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;

    private function __construct(
        Uuid $uuid,
        string $name,
        Season $season
    )
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->season = $season;
    }

    public static function createFromScratch(Uuid $uuid, string $name, Season $season): Tournament
    {
        $tournament = new self($uuid, $name, $season);
        $tournament->createdAt = $tournament->updatedAt = new \DateTime();

        return $tournament;
    }

    /**
     * @param $tournamentRepositoryData
     * @return Tournament
     * @throws \Exception
     */
    public static function createFromRepository($tournamentRepositoryData): Tournament
    {
        $tournament = new self(
            new Uuid($tournamentRepositoryData[0]),
            $tournamentRepositoryData[1],
            $tournamentRepositoryData[2]
        );
        $tournament->createdAt = new \DateTime($tournamentRepositoryData[3]);
        $tournament->updatedAt = new \DateTime($tournamentRepositoryData[4]);

        return $tournament;
    }

    public function uuid(): string
    {
        return $this->uuid->value();
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