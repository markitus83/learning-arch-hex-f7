<?php

namespace Fut7\Application\Tournament\CRUD\Update;

use Fut7\Domain\Entity\Season\Season;
use Fut7\Infrastructure\Shared\Utils\Uuid;

class UpdateTournamentCommand
{
    private string $uuid;
    private string $name;
    private Season $season;

    public function __construct($uuid, $name, $season)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->season = $season;
    }

    public function uuid(): string
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