<?php

namespace Tests\Feature;

use App\Models\Degree;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use JsonException;
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

        /** Create random degree so student can be attached to the newly created degree */
        Degree::factory()->createOne();
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
        $response = $this->actingAs($this->user)->post(route('student.store'), [
            'id' => rand(10000000, 99999999),
            'first_name' => 'John',
            'last_name' => 'Doe',
            'degree' => $Degree->__get('id')
        ]);

        $response->assertRedirect();
    }

    public function test_student_can_be_read(): void
    {
        $student = Student::factory()->createOne();
        $response = $this->actingAs($this->user)->get(route('student.show', $student->id));
        $response->assertStatus(200);
    }

    public function test_student_edit_screen_can_be_rendered_by_staff(): void
    {
        $student = Student::factory()->createOne();

        $response = $this->actingAs($this->user)->get(route('student.edit', $student->__get('id')));
        $response->assertStatus(200);
    }

    /**
     * @throws JsonException
     * @throws \Exception
     */
    public function test_student_can_be_updated(): void
    {
        // Create a random degree
        $degree = Degree::factory()->create();

        // Create a student
        $student = Student::factory()->create();

        // Update the student
        $response = $this->actingAs($this->user)->put('/student/' . $student->__get('id'), [
            'id' => $student->__get('id'),
            'first_name' => 'Jane',
            'last_name' => 'Seymour',
            'degree' => $degree->__get('id')
        ]);

        // Assert the response
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        // Refresh the student model instance to get updated data from the database
        $student->refresh();

        // Assert against the updated values
        $this->assertSame('Jane', $student->__get('first_name'));
        $this->assertSame('Seymour', $student->__get('last_name'));
        $this->assertSame($degree->__get('id'), $student->__get('degree_id'));
    }

    public function test_student_can_be_deleted(): void
    {
        $student = Student::factory()->createOne();
        $response = $this->actingAs($this->user)->delete(route('student.destroy', $student->__get('id')));
        $this->assertDatabaseMissing('students', [
            'id' => $student->__get('id'),
        ]);

        $response->assertRedirect();
    }
}
