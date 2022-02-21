<?php

namespace Fut7\Application\Tournament\CRUD\Delete;

class DeleteTournamentCommand
{
    private string $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }
}