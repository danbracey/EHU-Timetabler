<?php

namespace Tests\Feature;

use App\Models\Degree;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentTest extends TestCase
{
    private User $user;
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();

        //Set up an authenticated user
        $this->user = User::factory()->create();
    }

    /**
     * Test that the student index page cannot be rendered by guests
     * @return void
     */
    public function test_students_page_cannot_be_accessed_by_guests(): void
    {
        $response = $this->get(route('student.index'));
        $response->assertRedirect();
    }

    /**
     * Test that the student index page can be rendered by staff
     * @return void
     */
    public function test_students_page_can_be_accessed_by_staff(): void
    {
        $response = $this->actingAs($this->user)->get(route('student.index'));
        $response->assertStatus(200);
    }

    /**
     * Test student creation page can be rendered with form components
     * @return void
     */
    public function test_student_creation_page_can_be_rendered(): void
    {
        $response = $this->actingAs($this->user)->get(route('student.create'));
        $response->assertStatus(200);
    }

    /**
     * Test student creation page can be created
     * @return void
     */
    public function test_student_can_be_created(): void
    {
        $Degree = Degree::factory()->createOne();
        $response = $this->actingAs($this->user)->post(route('student.create'), [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'degree' => $Degree->__get('id')
        ]);

        $response->assertCreated();
        $response->assertRedirect();
    }

    public function test_student_can_be_read(): void
    {
        $student = Student::factory()->createOne();
        $response = $this->actingAs($this->user)->post(route('student.view', $student->id));
        $response->assertStatus(200);
    }

    public function test_student_edit_screen_can_be_rendered_by_staff(): void
    {
        $student = Student::factory()->createOne();

        $response = $this->actingAs($this->user)->get(route('student.edit', $student->__get('id')));
        $response->assertStatus(200);
    }

    public function test_student_can_be_updated(): void
    {
        $student = Student::factory()->createOne();

        $response = $this->actingAs($this->user)->patch(route('degree.update', $student->__get('id')), [
            'first_name' => 'Jane',
            'last_name' => 'Seymour'
        ]);

        $findStudent = Student::where('id', '=', 'W000')->firstOrFail();
        $this->assertEquals('Jane', $findStudent->first_name);
        $this->assertEquals('Seymour', $findStudent->first_name);

        $response->assertRedirect();
    }

    public function test_student_can_be_deleted(): void
    {
        $student = Student::factory()->createOne();

        $response = $this->actingAs($this->user)->delete(route('degree.destroy', $student->__get('id')));
        $this->assertDatabaseMissing('students', [
            'id' => $student->__get('id'),
        ]);

        $response->assertRedirect();
    }
}
