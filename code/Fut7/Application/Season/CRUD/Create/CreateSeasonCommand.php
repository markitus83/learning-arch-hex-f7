<?php

namespace Fut7\Application\Season\CRUD\Create;

use Fut7\Domain\Exception\Season\SeasonNameException;
use Fut7\Domain\Exception\Season\SeasonUuidException;
use Fut7\Domain\ValueObject\SeasonName;
use Fut7\Domain\ValueObject\SeasonUuid;

class CreateSeasonCommand
{
    private SeasonUuid $uuid;
    private SeasonName $name;

    /**
     * @throws SeasonUuidException
     * @throws SeasonNameException
     */
    public function __construct($uuid, $name)
    {
        $this->uuid = new SeasonUuid($uuid);
        $this->name = new SeasonName($name);
    }

    public function uuid(): SeasonUuid
    {
        return $this->uuid;
    }

    public function name(): SeasonName
    {
        return $this->name;
    }
}