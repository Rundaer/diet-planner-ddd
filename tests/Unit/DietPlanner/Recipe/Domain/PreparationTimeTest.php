<?php

namespace App\Tests\unit\DietPlanner\Recipe\Domain;

use App\DietPlanner\Recipe\Domain\Exception\InvalidPreparationTime;
use App\DietPlanner\Recipe\Domain\ValueObject\PreparationTime;
use App\Tests\unit\DietPlanner\Recipe\RecipeModuleUnitTestCase;
use PHPUnit\Framework\Attributes\Test;

class PreparationTimeTest extends RecipeModuleUnitTestCase
{
    #[Test]
    public function itShouldCreateValidPreparationTime()
    {
        $time = PreparationTime::fromMinutes(90);

        $this->assertEquals(90, $time->minutes());
        $this->assertEquals(1.5, $time->hours());
        $this->assertEquals("1 hour 30 minutes", (string)$time);
    }

    #[Test]
    public function itShouldThrowExceptionForTooShortPreparationTime()
    {
        $this->expectException(InvalidPreparationTime::class);
        PreparationTime::fromMinutes(0);
    }

    #[Test]
    public function itShouldThrowExceptionForTooLongPreparationTime()
    {
        $this->expectException(InvalidPreparationTime::class);
        PreparationTime::fromMinutes(1441);
    }

    #[Test]
    public function itShouldFormatStringRepresentationForMinutesOnly()
    {
        $time = PreparationTime::fromMinutes(45);
        $this->assertEquals("45 minutes", (string)$time);
    }

    #[Test]
    public function itShouldFormatStringRepresentationForSingularHourAndMinute()
    {
        $time = PreparationTime::fromMinutes(61);
        $this->assertEquals("1 hour 1 minute", (string)$time);
    }

    #[Test]
    public function itShouldAllowMinimumPreparationTime()
    {
        $time = PreparationTime::fromMinutes(1);
        $this->assertEquals(1, $time->minutes());
        $this->assertEquals("1 minute", (string)$time);
    }

    #[Test]
    public function itShouldAllowMaximumPreparationTime()
    {
        $time = PreparationTime::fromMinutes(1440);
        $this->assertEquals(1440, $time->minutes());
        $this->assertEquals(24, $time->hours());
        $this->assertEquals("24 hours 0 minutes", (string)$time);
    }

    #[Test]
    public function itShouldCorrectlyConvertToHours()
    {
        $time = PreparationTime::fromMinutes(150);
        $this->assertEquals(2.5, $time->hours());
    }

    #[Test]
    public function itShouldFormatStringRepresentationForFullHours()
    {
        $time = PreparationTime::fromMinutes(120);
        $this->assertEquals("2 hours 0 minutes", (string)$time);
    }
}
