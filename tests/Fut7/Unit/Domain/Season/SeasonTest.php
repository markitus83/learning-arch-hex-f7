<?php

namespace Fut7\Unit\Domain\Season;

use Fut7\Domain\Entity\Season\Season;
use http\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class SeasonTest extends TestCase
{
    public function testCreateSeasonWithBasicValuesFromScratch()
    {
        $id = uniqid();
        $name = 'seasonFake';

        $season = Season::createFromScratch($id, $name);
        $this->assertInstanceOf(Season::class, $season, 'Failed test create Season with basic values');
    }

    public function testCreateSeasonWithoutNameFromScratch()
    {
        $id = uniqid();
        $name = null;

        $this->expectException(\TypeError::class);

        $season = Season::createFromScratch($id, $name);
        $this->assertInstanceOf(Season::class, $season, 'Failed test create Season without name');
    }

    public function testCreateSeasonWithoutIdFromScratch()
    {
        $id = null;
        $name = 'seasonFake';

        $this->expectException(\TypeError::class);

        $season = Season::createFromScratch($id, $name, 5656);
        $this->assertInstanceOf(Season::class, $season, 'Failed test create Season without id');
    }
}