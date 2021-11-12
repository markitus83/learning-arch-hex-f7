<?php namespace Fut7\Domain\Response\Season;

use Fut7\Domain\Contract\Response\DomainResponseInterface;

class SearchSeasonResponse implements DomainResponseInterface
{
    private $seasons;

    public function __construct($seasons)
    {
        $this->seasons = $seasons;
    }

    public function seasons()
    {
        return $this->seasons;
    }

    public function getResponse(): string
    {
        return 'seasons searched';
    }
}