<?php

namespace Fut7\Domain\Entity\Season;

use Fut7\Domain\ValueObject\SeasonName;
use Fut7\Domain\ValueObject\SeasonUuid;
use Fut7\Infrastructure\Shared\Utils\Uuid;

class Season
{
    private SeasonUuid $uuid;
    private SeasonName $name;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;

    private function __construct(
        SeasonUuid $uuid,
        SeasonName $name
    )
    {
        $this->uuid = $uuid;
        $this->name = $name;
    }

    /**
     * @param SeasonUuid $uuid
     * @param SeasonName $name
     * @return Season
     */
    public static function createFromScratch(SeasonUuid $uuid, SeasonName $name): Season
    {
        $season = new self($uuid, $name);
        $season->createdAt = $season->updatedAt = new \DateTime();

        return $season;
    }

    /**
     * @throws \Exception
     */
    public static function createFromRepository($seasonRepositoryData): Season
    {
        $season = new self(
            new SeasonUuid(new Uuid($seasonRepositoryData[0])),
            $seasonRepositoryData[1]
        );
        $season->createdAt = new \DateTime($seasonRepositoryData[2]);
        $season->updatedAt = new \DateTime($seasonRepositoryData[3]);

        return $season;
    }

    public function uuid(): string
    {
        return $this->uuid;
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