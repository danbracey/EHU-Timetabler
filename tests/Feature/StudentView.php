<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentView extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    /**
     * A basic feature test example.
     */
    public function test_example_student_details_render_correctly(): void
    {
        $student = Student::factory()->createOne();
        $response = $this->get('/' . $student->__get('id'));

        $response->assertStatus(200);
        $response->assertSeeText($student->__get('first_name'));
        $response->assertSeeText($student->__get('last_name'));
    }
}
