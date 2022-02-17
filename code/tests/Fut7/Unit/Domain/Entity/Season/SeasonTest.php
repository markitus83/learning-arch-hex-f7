<?php

namespace Fut7\Unit\Domain\Entity\Season;

use Fut7\Domain\Entity\Season\Season;
use Fut7\Infrastructure\Shared\Utils\Uuid;
use PHPUnit\Framework\TestCase;

class SeasonTest extends TestCase
{
    public function testCreateSeasonWithBasicValuesFromScratch()
    {
        $uuid = new Uuid();
        $name = 'seasonFake';

        $season = Season::createFromScratch($uuid, $name);
        $this->assertInstanceOf(Season::class, $season, 'Failed test create Season with basic values');
    }

    public function testCreateSeasonWithoutNameFromScratch()
    {
        $uuid = new Uuid();
        $name = null;

        $this->expectException(\TypeError::class);

        $season = Season::createFromScratch($uuid, $name);
        $this->assertInstanceOf(Season::class, $season, 'Failed test create Season without name');
    }

    public function testCreateSeasonWithoutIdFromScratch()
    {
        $uuid = null;
        $name = 'seasonFake';

        $this->expectException(\TypeError::class);

        $season = Season::createFromScratch($uuid, $name, 5656);
        $this->assertInstanceOf(Season::class, $season, 'Failed test create Season without id');
    }
}