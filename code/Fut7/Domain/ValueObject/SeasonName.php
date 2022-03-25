<?php

namespace Fut7\Domain\ValueObject;


class SeasonName
{
    private $value;

    public function __construct($value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    private function validate($value)
    {
        $this->validateEmptyValue($value);
    }

    private function validateEmptyValue($value)
    {
        if (empty(trim($value))) {

        }
        return true;
    }

    public function __toString()
    {
        return $this->value;
    }

}