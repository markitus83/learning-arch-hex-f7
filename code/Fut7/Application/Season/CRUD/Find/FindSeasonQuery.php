<?php

namespace Fut7\Application\Season\CRUD\Find;

class FindSeasonQuery
{
    private string $uuid;

    public function __construct($uuid)
    {
        if ('string' !== gettype($uuid)) {
            throw new \TypeError("Uuid to find must be a string!!");
        }

        $this->uuid = $uuid;
    }

    public function uuid(): string
    {
        return $this->uuid;
    }

}