<?php

namespace Tests\Feature;

use App\Models\Degree;
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

        $student = Student::factory()->createOne();
        $this->response = $this->get('/?student_id=' . $student->__get('id'));
        $this->student = $student->__get('id');
    }

    /**
     * Student can see their student details
     */
    public function test_student_details_render_correctly(): void
    {
        $this->response->assertStatus(200);
        $this->response->assertSeeText($this->student->__get('first_name'));
        $this->response->assertSeeText($this->student->__get('last_name'));
        $this->response->assertSeeText($this->student->degree->__get('name'));
    }

    public function test_student_today_block_renders_correctly(): void
    {
        $this->response->assertSeeText("Today");

        //Get the number of classes a student has today


        $this->response->assertSeeText("Classes");
        $this->response->assertSeeText("Next class:");
    }
}
