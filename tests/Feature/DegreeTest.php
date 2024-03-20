<?php
namespace Tests\Feature;

use App\Models\Degree;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class DegreeTest extends TestCase
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

    public function test_degree_screen_cannot_be_accessed_by_unauthenticated_users(): void
    {
        $response = $this->get(route('degree.index'));
        $response->assertRedirect();
    }

    public function test_degrees_index_screen_can_be_rendered_by_staff(): void
    {
        $response = $this->actingAs($this->user)->get('/degree/');
        $response->assertStatus(200);
    }

    public function test_degree_creation_screen_cannot_be_accessed_by_unauthenticated_users(): void
    {
        $response = $this->get('/degree/create');
        $response->assertRedirect();
    }

    public function test_degree_creation_screen_can_be_rendered_by_staff(): void
    {
        $response = $this->actingAs($this->user)->get('/degree/create');
        $response->assertStatus(200);
    }

    public function test_degree_can_be_created(): void
    {
        $response = $this->actingAs($this->user)->post(route('degree.store'), [
            'id' => 'W4D7',
            'friendly_name' => 'Web Design & Development'
        ]);

        $response->assertRedirect();
    }

    public function test_degree_edit_screen_can_be_rendered_by_staff(): void
    {
        $degree = Degree::factory()->createOne();

        $response = $this->actingAs($this->user)->get(route('degree.edit', $degree->__get('id')));
        $response->assertStatus(200);
    }

    public function test_degree_can_be_updated(): void
    {
        $degree = Degree::factory()->createOne();

        $response = $this->actingAs($this->user)->patch(route('degree.update', $degree->__get('id')), [
            'id' => 'W000',
            'friendly_name' => 'Web Development & Design'
        ]);

        $degree = Degree::where('id', '=', 'W000')->firstOrFail();
        $this->assertModelExists($degree);

        $response->assertRedirect();
    }

    public function test_degree_can_be_deleted(): void
    {
        $degree = Degree::factory()->createOne();

        $response = $this->actingAs($this->user)->delete(route('degree.destroy', $degree->__get('id')));
        $this->assertDatabaseMissing('degrees', [
            'id' => $degree->__get('id'),
        ]);

        $response->assertRedirect();
    }
}
