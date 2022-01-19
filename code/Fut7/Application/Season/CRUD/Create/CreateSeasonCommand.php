<?php namespace Fut7\Application\Season\CRUD\Create;


use Fut7\Infrastructure\Shared\Utils\Uuid;

class CreateSeasonCommand
{
    private Uuid $uuid;
    private string $name;

    public function __construct($uuid, $name)
    {
        $this->uuid = $uuid;
        $this->name = $name;
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