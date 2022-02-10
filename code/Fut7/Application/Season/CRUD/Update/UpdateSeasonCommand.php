<?php

namespace Fut7\Application\Season\CRUD\Update;

class UpdateSeasonCommand
{
    private string $uuid;
    private string $name;

    public function __construct($uuid, $name)
    {
        $this->uuid = $uuid;
        $this->name = $name;
    }

    public function uuid(): string
    {
        return $this->uuid;
    }

    public function name(): string
    {
        return $this->name;
    }
}