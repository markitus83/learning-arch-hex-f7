<?php

namespace Fut7\Application\Season\CRUD\Find;

use Fut7\Domain\Exception\Season\SeasonUuidException;

class FindSeasonQuery
{
    private string $uuid;

    /**
     * @throws SeasonUuidException
     */
    public function __construct($uuid)
    {
        if (null === $uuid) {
            throw new SeasonUuidException('Season uuid not must be null or empty');
        }

        $this->uuid = $uuid;
    }

    public function uuid(): string
    {
        return $this->uuid;
    }

}