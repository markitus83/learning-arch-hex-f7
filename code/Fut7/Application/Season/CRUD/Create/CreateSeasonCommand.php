<?php

namespace Fut7\Application\Season\CRUD\Create;

use Fut7\Domain\ValueObject\SeasonName;
use Fut7\Infrastructure\Shared\Utils\Uuid;

class CreateSeasonCommand
{
    private Uuid $uuid;
    private SeasonName $name;

    public function __construct($uuid, $name)
    {
        if (null === $name || 'string' !== gettype($name)) {
            throw new \TypeError("Name must be a string!!");
        }
        if (!($uuid instanceof Uuid)) {
            throw new \TypeError("Uuid must be an instance of Uuid!!");
        }

        $this->uuid = $uuid;
        $this->name = new SeasonName($name);
    }

    public function uuid(): Uuid
    {
        return $this->uuid;
    }

    public function name(): string
    {
        return $this->name;
    }
}