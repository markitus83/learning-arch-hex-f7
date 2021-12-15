<?php

namespace Fut7\Application\Tournament\CRUD\Search;

class SearchTournamentQuery
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