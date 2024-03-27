<?php
namespace Feature;

use App\Models\Building;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class BuildingTest extends TestCase
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

    public function test_building_screen_cannot_be_accessed_by_unauthenticated_users(): void
    {
        $response = $this->get(route('estates.building.index'));
        $response->assertRedirect();
    }

    public function test_buildings_index_screen_can_be_rendered_by_staff(): void
    {
        $response = $this->actingAs($this->user)->get('/building/');
        $response->assertStatus(200);
    }

    public function test_building_creation_screen_cannot_be_accessed_by_unauthenticated_users(): void
    {
        $response = $this->get('/building/create');
        $response->assertRedirect();
    }

    public function test_building_creation_screen_can_be_rendered_by_staff(): void
    {
        $response = $this->actingAs($this->user)->get('/building/create');
        $response->assertStatus(200);
    }

    public function test_building_can_be_created(): void
    {
        $response = $this->actingAs($this->user)->post(route('building.store'), [
            'friendly_name' => 'Tech Hub'
        ]);

        $response->assertRedirect();
    }

    public function test_building_edit_screen_can_be_rendered_by_staff(): void
    {
        $building = Building::factory()->createOne();

        $response = $this->actingAs($this->user)->get(route('building.edit', $building->__get('id')));
        $response->assertStatus(200);
    }

    public function test_building_can_be_updated(): void
    {
        $building = Building::factory()->createOne();

        $response = $this->actingAs($this->user)->patch(route('building.update', $building->__get('id')), [
            'friendly_name' => 'Catalyst'
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        // Refresh the student model instance to get updated data from the database
        $building->refresh();

        // Assert against the updated values
        $this->assertSame('Catalyst', $building->__get('friendly_name'));
        $this->assertSame($building->__get('id'), $building->__get('degree_id'));
    }

    public function test_building_can_be_deleted(): void
    {
        $building = Building::factory()->createOne();

        $response = $this->actingAs($this->user)->delete(route('building.destroy', $building->__get('id')));
        $this->assertDatabaseMissing('buildings', [
            'id' => $building->__get('id'),
        ]);

        $response->assertRedirect();
    }
}
