<?php

namespace Fut7\Infrastructure\Shared\Utils;

use Ramsey\Uuid\Uuid as RamseyUuid;
class Uuid
{
    private string $value;

    public function __construct()
    {
        $this->value = RamseyUuid::uuid4()->toString();
    }

    public function value(): String
    {
        return $this->value;
    }
}