<?php

namespace Fut7\Application\Season\CRUD\Search;

class SearchSeasonQuery
{
    private array $criteria;

    public function __construct($criteria)
    {
        $this->criteria = $criteria;
    }

    public function criteria(): array
    {
        return $this->criteria;
    }
}