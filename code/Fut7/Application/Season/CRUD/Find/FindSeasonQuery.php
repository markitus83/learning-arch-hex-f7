<?php namespace Fut7\Application\Season\CRUD\Find;

class FindSeasonQuery
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