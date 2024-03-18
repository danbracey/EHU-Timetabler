<?php
namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DegreeTest extends TestCase
{
    use RefreshDatabase;
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();

        //Set up an authenticated user
        $this->user = User::factory()->create();
    }

    public function test_degree_screen_cannot_be_accessed_by_unauthenticated_users(): void
    {
        $response = $this->get('/degrees');
        $response->assertRedirect();
    }

    public function test_degrees_index_screen_can_be_rendered_by_staff(): void
    {
        $response = $this->actingAs($this->user)->get('/degrees');
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
        $response = $this->actingAs($this->user)->post('/degree/create', [
            'id' => 'WD47',
            'friendly_name' => 'Web Design & Development'
        ]);

        $response->assertStatus(201);
    }
}
