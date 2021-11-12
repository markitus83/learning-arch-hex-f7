<?php namespace F7\Domain\Entity;

use SharedKernel\...\Uuid;

class Season extends BaseEntity
{
    private Uuid $id;
    private string name;
    private \DateTime createdAt;
    private \DateTime updatedAt;

    private function __construct(
        Uuid $uuid,
        string $name
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