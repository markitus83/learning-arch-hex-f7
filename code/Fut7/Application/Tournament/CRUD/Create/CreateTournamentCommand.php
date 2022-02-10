<?php

namespace Fut7\Application\Tournament\CRUD\Create;

use Fut7\Domain\Entity\Season\Season;
use Fut7\Infrastructure\Shared\Utils\Uuid;

class CreateTournamentCommand
{
    private Uuid $uuid;
    private string $name;
    private Season $season;

    public function __construct(Uuid $uuid, string $name, Season $season)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->season = $season;
    }

    public function uuid(): Uuid
    {
        return $this->uuid;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function season(): Season
    {
        return $this->season;
    }

}