<?php

namespace Fut7\Application\Season\CRUD\Delete;

class DeleteSeasonCommand
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