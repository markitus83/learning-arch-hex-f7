<?php

namespace Fut7\Application\Season\CRUD\Search;

class SearchSeasonQuery
{
    private $criteria;

    public function __construct($criteria)
    {
        $this->criteria = $criteria;
    }

    public function criteria()
    {
        return $this->criteria;
    }
}