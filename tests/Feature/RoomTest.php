<?php
namespace Feature;

use App\Models\Building;
use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class RoomTest extends TestCase
{
    private User $user;
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();

        //Set up an authenticated user
        $this->user = User::factory()->create();
        //Set up a building, only one needed throughout to test relationships
        $this->building = Building::factory()->createOne();
    }

    // No index page for Rooms, accessed via Rooms only.

    public function test_room_creation_screen_cannot_be_accessed_by_unauthenticated_users(): void
    {
        $response = $this->get(route('room.create', $this->building));
        $response->assertRedirect();
    }

    public function test_room_creation_screen_can_be_rendered_by_staff(): void
    {
        $response = $this->actingAs($this->user)->get(route('room.create', $this->building));
        $response->assertStatus(200);
    }

    public function test_room_can_be_created(): void
    {
        $response = $this->actingAs($this->user)->post(route('room.store', $this->building), [
            'id' => 'THG05',
            'available_seats' => 30,
            'available_computers' => 30,
            'is_lecture_hall' => false,
            'building' => $this->building->__get('id')
        ]);

        $this->assertModelExists(Room::where('id', '=', 'THG05')->firstOrFail());
        $response->assertRedirect();
    }

    public function test_room_edit_screen_can_be_rendered_by_staff(): void
    {
        $room = Room::factory()->createOne();

        $response = $this->actingAs($this->user)->get(route('room.edit', [$room->__get('building'), $room->__get('id')]));
        $response->assertStatus(200);
    }

    public function test_rooms_edit_screen_has_delete_room_button(): void
    {
        $room = Room::factory()->createOne();

        $response = $this->actingAs($this->user)->get(route('room.edit', [$room->__get('building'), $room->__get('id')]));
        $response->assertSeeText('Delete Room');
    }

    /**
     * @throws \JsonException
     */
    public function test_room_can_be_updated(): void
    {
        $room = Room::factory()->createOne();

        $response = $this->actingAs($this->user)->patch(route('room.update', [$room->__get('building'), $room->__get('id')]), [
            'id' => $room->id,
            'available_seats' => 20,
            'available_computers' => 10,
            'is_lecture_hall' => 1,
            'building' => $this->building->__get('id')
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        // Refresh the Room model instance to get updated data from the database
        $room->refresh();

        // Assert against the updated values
        $this->assertSame(20, $room->__get('available_seats'));
        $this->assertSame(10, $room->__get('available_computers'));
        $this->assertSame(1, $room->__get('is_lecture_hall'));
        $this->assertSame($this->building->__get('id'), $room->__get('building'));
        $this->assertSame($room->__get('id'), $room->__get('id'));
    }

    public function test_room_can_be_deleted(): void
    {
        $room = Room::factory()->createOne();

        $response = $this->actingAs($this->user)->delete(route('room.destroy', [$room->__get('building'), $room->__get('id')]));
        $this->assertDatabaseMissing('rooms', [
            'id' => $room->__get('id'),
        ]);

        $response->assertRedirect();
    }
}
