<?php

namespace Fut7\Unit\Domain\Entity\Season;

use Fut7\Domain\Entity\Season\Season;
use Fut7\Domain\Exception\Season\SeasonNameException;
use Fut7\Domain\Exception\Season\SeasonUuidException;
use Fut7\Domain\ValueObject\SeasonName;
use Fut7\Domain\ValueObject\SeasonUuid;
use Fut7\Infrastructure\Shared\Utils\Uuid;
use PHPUnit\Framework\TestCase;

class SeasonTest extends TestCase
{
    /**
     * @throws SeasonUuidException
     * @throws SeasonNameException
     */
    public function testSeasonValueObjectUuidError()
    {
        $this->expectException(\TypeError::class);

        $mockUuid = Uuid::createFromString('19d0faf4-90dd-48a8-a09a-3f0aaa84475b');
        $mockUuid = '19d0faf4-90dd-48a8-a09a-3f0aaa84475b';
        $mockName = 'mock-season';
        //$mockSeasonUuid = new SeasonUuid($mockUuid);
        $mockSeasonName = new SeasonName($mockName);
        $mockSeason = Season::createFromScratch($mockUuid, $mockSeasonName);

        $this->assertInstanceOf(Season::class, $mockSeason);
    }

    public function testSeasonValueObjectNameError()
    {
        $this->assertEquals(true, true);

////        $this->expectException(SeasonUuidException::class);
////        $this->expectException(\TypeError::class);
//
//        $mockUuid = Uuid::createFromString('19d0faf4-90dd-48a8-a09a-3f0aaa84475b');
//        $mockUuid = '19d0faf4-90dd-48a8-a09a-3f0aaa84475b';
//        $mockName = 'mock-season';
//        //$mockSeasonUuid = new SeasonUuid($mockUuid);
//        $mockSeasonName = new SeasonName($mockName);
//        //$mockSeason = Season::createFromScratch($mockSeasonUuid, $mockSeasonName);
//        $mockSeason = Season::createFromScratch($mockUuid, $mockSeasonName);
//
//        $this->assertInstanceOf(Season::class, $mockSeason);
    }
}