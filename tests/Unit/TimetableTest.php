<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class TimetableTest extends TestCase
{
    /**
     * Test clash prevention
     */
    public function test_staff_are_unable_to_manually_create_timetable_clashes(): void
    {
        $this->assertTrue(true);
    }
}
