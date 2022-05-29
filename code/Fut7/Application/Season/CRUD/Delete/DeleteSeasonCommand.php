<?php

namespace Fut7\Application\Season\CRUD\Delete;

class DeleteSeasonCommand
{
    private string $uuid;

    public function __construct($uuid)
    {
        $this->uuid = $uuid;
    }

    public function uuid(): string
    {
        return $this->uuid;
    }
}