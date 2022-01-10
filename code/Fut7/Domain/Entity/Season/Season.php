<?php namespace Fut7\Domain\Entity\Season;

class Season
{
    private string $id;
    private string $name;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;

    private function __construct(
        string $id,
        string $name
    )
    {
        $this->id = $id;
        $this->name = $name;
    }

    public static function createFromScratch(string $id, string $name): Season
    {
        $season = new self($id, $name);
        $season->createdAt = $season->updatedAt = new \DateTime();

        return $season;
    }

    public static function createFromRepository($seasonRepositoryData): Season
    {
        $season = new self(
            $seasonRepositoryData[0],
            $seasonRepositoryData[1]
        );
        $season->createdAt = new \DateTime($seasonRepositoryData[2]);
        $season->updatedAt = new \DateTime($seasonRepositoryData[3]);

        return $season;
    }

    public function id(): string
    {
        return $this->id;
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