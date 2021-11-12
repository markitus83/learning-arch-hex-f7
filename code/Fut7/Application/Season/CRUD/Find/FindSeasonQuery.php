<?php namespace Fut7\Application\Season\CRUD\Find;

class FindSeasonQuery
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