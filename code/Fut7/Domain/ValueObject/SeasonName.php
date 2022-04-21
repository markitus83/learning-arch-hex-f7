<?php

namespace Fut7\Domain\ValueObject;


use Fut7\Domain\Exception\Season\SeasonNameException;

class SeasonName
{
    private string $value;

    /**
     * @throws SeasonNameException
     */
    public function __construct($value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    /**
     * @throws SeasonNameException
     */
    private function validate($value)
    {
        $this->validateEmptyValue($value);
    }

    /**
     * @param $value
     * @throws SeasonNameException
     */
    private function validateEmptyValue($value)
    {
        if (empty(trim($value))) {
            throw new SeasonNameException('Season name is mandatory');
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }

}