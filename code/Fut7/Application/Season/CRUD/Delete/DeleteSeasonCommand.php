<?php

namespace Fut7\Application\Season\CRUD\Update;

class DeleteSeasonCommand
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function id()
    {
        return $this->id;
    }
}