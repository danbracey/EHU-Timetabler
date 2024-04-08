<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Helpers\TimeslotFunctions;

class GenerationTest extends TestCase
{
    public function test_timetable_generation(): void
    {
        $test = TimeslotFunctions::generateTimetable();
        $this->assertTrue($test);
    }
}
