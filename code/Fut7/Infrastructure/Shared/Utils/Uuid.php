<?php

namespace Fut7\Infrastructure\Shared\Utils;

use Ramsey\Uuid\Uuid as RamseyUuid;
class Uuid
{
    private string $value;

    public function __construct(string $stringUuid = null)
    {
        if (null === $stringUuid) {
            $this->value = RamseyUuid::uuid4()->toString();
        } else {
            $this->value = RamseyUuid::fromString($stringUuid);
        }
    }

    public static function createFromString(string $stringUuid)
    {
        return new self($stringUuid);
    }

    public function value(): String
    {
        return $this->value;
    }
}