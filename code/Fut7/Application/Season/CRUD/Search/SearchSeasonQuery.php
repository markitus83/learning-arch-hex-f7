<?php

namespace Fut7\Application\Season\CRUD\Search;

use Fut7\Domain\Exception\Season\SeasonSearchEmptyCriteriaException;

class SearchSeasonQuery
{
    private array $criteria;

    /**
     * @throws SeasonSearchEmptyCriteriaException
     */
    public function __construct($criteria)
    {
        //echo PHP_EOL.'SearchSeasonQuery >> gettype($criteria) >> '.gettype($criteria);
        if (null === $criteria || 'array' !== gettype($criteria)) {
            throw new \TypeError("Criteria must be an array!! ".gettype($criteria));
        }
        if (empty($criteria)) {
            throw new SeasonSearchEmptyCriteriaException('Criteria can not be empty!!');
        }

        $this->criteria = $criteria;
    }

    public function criteria(): array
    {
        return $this->criteria;
    }
}