<?php

namespace Feature;

use App\Models\Module;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JsonException;
use Tests\TestCase;

class ModuleTest extends TestCase
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
     * Test that the module index page cannot be rendered by guests
     * @return void
     */
    public function test_modules_page_cannot_be_accessed_by_guests(): void
    {
        $response = $this->get(route('module.index'));
        $response->assertRedirect();
    }

    /**
     * Test that the module index page can be rendered by staff
     * @return void
     */
    public function test_modules_page_can_be_accessed_by_staff(): void
    {
        $response = $this->actingAs($this->user)->get(route('module.index'));
        $response->assertStatus(200);
    }

    /**
     * Test module creation page can be rendered with form components
     * @return void
     */
    public function test_module_creation_page_can_be_rendered(): void
    {
        $response = $this->actingAs($this->user)->get(route('module.create'));
        $response->assertStatus(200);
    }

    /**
     * Test module creation page can be created
     * @return void
     */
    public function test_module_can_be_created(): void
    {
        $response = $this->actingAs($this->user)->post(route('module.store'), [
            'id' => 'CIS' . rand(0000, 3999),
            'friendly_name' => 'Example Module',
            'academic_year' => '23/24',
        ]);

        $response->assertRedirect();
    }

    public function test_module_can_be_read(): void
    {
        $module = Module::factory()->createOne();
        $response = $this->actingAs($this->user)->get(route('module.show', $module->__get('id')));
        $response->assertStatus(200);
    }

    public function test_module_edit_screen_can_be_rendered_by_staff(): void
    {
        $module = Module::factory()->createOne();

        $response = $this->actingAs($this->user)->get(route('module.edit', $module->__get('id')));
        $response->assertStatus(200);
    }

    /**
     * @throws JsonException
     */
    public function test_module_can_be_updated(): void
    {
        // Create a random module
        $module = Module::factory()->create();

        // Update the student
        $response = $this->actingAs($this->user)->put(route('module.update', $module->__get('id')), [
            'id' => $module->__get('id'),
            'friendly_name' => 'Different Module',
            'academic_year' => '23/24',
            'degrees' => []
        ]);

        // Assert the response
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        // Refresh the module model instance to get updated data from the database
        $module->refresh();

        // Assert against the updated values
        $this->assertSame('Different Module', $module->__get('friendly_name'));
        $this->assertSame('23/24', $module->__get('academic_year'));
    }

    public function test_module_can_be_deleted(): void
    {
        $module = Module::factory()->createOne();
        $response = $this->actingAs($this->user)->delete(route('student.destroy', $module->__get('id')));
        $this->assertDatabaseMissing('students', [
            'id' => $module->__get('id'),
        ]);

        $response->assertRedirect();
    }
}
