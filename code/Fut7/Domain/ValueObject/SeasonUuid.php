<?php

namespace Fut7\Domain\ValueObject;

use Fut7\Domain\Exception\Season\SeasonUuidException;
use Fut7\Infrastructure\Shared\Utils\Uuid;

class SeasonUuid
{
    private Uuid $value;

    /**
     * @throws SeasonUuidException
     */
    public function __construct($value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    /**
     * @throws SeasonUuidException
     */
    private function validate($value)
    {
        $this->validateInstanceUuid($value);
        $this->validateEmptyValue($value);
    }

    /**
     * @param $value
     * @throws SeasonUuidException
     */
    private function validateInstanceUuid($value)
    {
        if (!($value instanceof Uuid)) {
            throw new SeasonUuidException('Season uuid must be instance of an Uuid');
        }
    }

    /**
     * @param $value
     * @throws SeasonUuidException
     */
    private function validateEmptyValue($value)
    {
        if (empty(trim($value->value()))) {
            throw new SeasonUuidException('Season uuid is mandatory');
        }
    }

    public function __toString(): string
    {
        return $this->value->value();
    }
}