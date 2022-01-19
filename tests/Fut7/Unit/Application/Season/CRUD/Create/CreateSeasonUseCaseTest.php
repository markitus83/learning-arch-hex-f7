<?php

namespace Fut7\Unit\Application\Season\CRUD\Create;

use Fut7\Application\Season\CRUD\Create\CreateSeasonUseCase;
use Fut7\Domain\Entity\Season\Season;
use Fut7\Domain\Response\Season\CreateSeasonResponse;
use PHPUnit\Framework\TestCase;

class CreateSeasonUseCaseTest extends TestCase
{
    public function testCreateSeasonWithBasicValuesFromScratch()
    {
        $id = uniqid();
        $name = 'seasonFake';

        $season = Season::createFromScratch($id, $name);
        $this->assertInstanceOf(Season::class, $season, 'Failed test create Season with basic values');

        $seasonCommand = asdads;
        $useCase = new CreateSeasonUseCase($seasonCommand);
        $this->assertInstanceOf(CreateSeasonResponse::class, $useCase);
    }

    public function testCreateSeasonWithoutNameFromScratch()
    {
        $id = uniqid();
        $name = null;
        $this->assertNotNull($id, 'Id is null');
        $this->assertNotNull($name, 'Name is null');

        $season = Season::createFromScratch($id, $name);
        $this->assertInstanceOf(Season::class, $season, 'Failed test create Season without name');
    }

    public function testCreateSeasonWithoutIdFromScratch()
    {
        $id = null;
        $name = 'seasonFake';
        $this->assertNotNull($id, 'Id is null');
        $this->assertNotNull($name, 'Name is null');

        $season = Season::createFromScratch($id, $name);
        $this->assertInstanceOf(Season::class, $season, 'Failed test create Season without id');
    }
}