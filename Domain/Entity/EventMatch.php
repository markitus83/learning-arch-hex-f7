<?php namespace F7\Domain\Entity;

use SharedKernel\...\Uuid;
use F7\Domain\Entity\Match;
use F7\Domain\Entity\Player;

class EventMatch extends BaseEntity
{
    private Uuid $id; ##>> uuid en hexdec (en binary) [uso para ref entre tablas]
    private Uuid $uuid; ##>> uso para func CRUD
    private string name;
    private Match $match;
    private Player $player;
    private \DateTime createdAt;
    private \DateTime updatedAt;

    private function __construct(
        Uuid $uuid,
        string $name,
        int $amount,
        Match $match,
        Player $player
    )
    {
        $this->id = $uuid;
        $this->name = $name;
        $this->amount = $amount;
        $this->match = $match;
        $this->player = $player;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function match(): Team
    {
        return $this->match;
    }

    public function player(): Team
    {
        return $this->player;
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