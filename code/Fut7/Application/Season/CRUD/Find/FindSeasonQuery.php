<?php namespace Fut7\Application\Season\CRUD\Find;

class FindSeasonQuery
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