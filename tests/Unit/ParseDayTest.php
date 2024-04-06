<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Helpers\TimeslotFunctions;

/** This entire test checks the Helper function parseDay, to ensure the correct day is matched */
class ParseDayTest extends TestCase
{
    public function test_monday_renders(): void
    {
        $day = TimeslotFunctions::parseDay(1);
        $this->assertEquals("Monday", $day);
    }

    public function test_tuesday_renders(): void
    {
        $day = TimeslotFunctions::parseDay(2);
        $this->assertEquals("Tuesday", $day);
    }

    public function test_wednesday_renders(): void
    {
        $day = TimeslotFunctions::parseDay(3);
        $this->assertEquals("Wednesday", $day);
    }

    public function test_thursday_renders(): void
    {
        $day = TimeslotFunctions::parseDay(4);
        $this->assertEquals("Thursday", $day);
    }

    public function test_friday_renders(): void
    {
        $day = TimeslotFunctions::parseDay(5);
        $this->assertEquals("Friday", $day);
    }

    public function test_saturday_renders(): void
    {
        $day = TimeslotFunctions::parseDay(6);
        $this->assertEquals("Saturday", $day);
    }

    public function test_sunday_renders(): void
    {
        $day = TimeslotFunctions::parseDay(7);
        $this->assertEquals("Sunday", $day);
    }

    public function test_invalid_renders_unknown(): void
    {
        $day = TimeslotFunctions::parseDay(999);
        $this->assertEquals("Unknown", $day);
    }
}
