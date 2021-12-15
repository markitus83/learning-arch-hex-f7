<?php

namespace Fut7\Application\Tournament\CRUD\Update;

use Fut7\Domain\Entity\Season\Season;

class UpdateTournamentCommand
{
    private string $id;
    private string $name;
    private Season $season;

    public function __construct($id, $name, $season)
    {
        $this->id = $id;
        $this->name = $name;
        $this->season = $season;
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
}