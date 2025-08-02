<?php

namespace Tests\Feature;

use App\Enums\EventStatusEnum;
use App\Enums\EventTypeEnum;
use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventCrudTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        // Create a user and store it for use in tests
        $this->user = User::factory()->create();
    }

    public function test_can_create_an_event()
    {
        $data = [
            'name' => 'Test Event',
            'start_time' => now()->addDay()->format('Y-m-d H:i:s'),
            'end_time' => now()->addDays(2)->format('Y-m-d H:i:s'),
            'description' => 'A test event',
            'location' => 'Test Location',
            'organizer' => 'Test Organizer',
            'type' => EventTypeEnum::CONFERENCE->value,
            'url' => 'https://example.com',
            // 'image' => 'https://example.com/image.png',
            'created_by' => 1,
            'status' => EventStatusEnum::SCHEDULED->value,
        ];

        $response = $this->actingAs($this->user)->post('/events', $data);
        $response->assertRedirect();
        // $this->assertDatabaseHas('events', ['name' => 'Test Event']);
    }

    public function test_can_update_an_event()
    {
        $event = Event::factory([
            'event_id' => 'EVT-001',
            'name' => 'Fresh Event',
            'start_time' => now()->addDay()->format('Y-m-d H:i:s'),
            'end_time' => now()->addDays(2)->format('Y-m-d H:i:s'),
            'description' => 'Fresh description',
            'location' => 'Fresh Location',
            'organizer' => 'Fresh Organizer',
            'type' => EventTypeEnum::WEBINAR->value,
            'url' => 'https://example.com/Fresh',
            // 'image' => 'https://example.com/image2.png',
            'created_by' => 1,
            'status' => EventStatusEnum::ONGOING->value
        ])->create();

        $data = [
            'event_id' => $event->event_id,
            'name' => 'Updated Event',
            'start_time' => now()->addDay()->format('Y-m-d H:i:s'),
            'end_time' => now()->addDays(2)->format('Y-m-d H:i:s'),
            'description' => 'Updated description',
            'location' => 'Updated Location',
            'organizer' => 'Updated Organizer',
            'type' => EventTypeEnum::WEBINAR->value,
            'url' => 'https://example.com/updated',
            // 'image' => 'https://example.com/image2.png',
            'created_by' => 1,
            'status' => EventStatusEnum::ONGOING->value,
        ];

        $response = $this->actingAs($this->user)->put("/events/{$event->id}", $data);
        $response->assertRedirect();
        $this->assertDatabaseHas('events', ['id' => $event->id]);
    }

    public function test_can_show_an_event()
    {
        $event = Event::factory([
            'event_id' => 'EVT-001',
            'name' => 'Fresh Event',
            'start_time' => now()->addDay()->format('Y-m-d H:i:s'),
            'end_time' => now()->addDays(2)->format('Y-m-d H:i:s'),
            'description' => 'Fresh description',
            'location' => 'Fresh Location',
            'organizer' => 'Fresh Organizer',
            'type' => EventTypeEnum::WEBINAR->value,
            'url' => 'https://example.com/Fresh',
            // 'image' => 'https://example.com/image2.png',
            'created_by' => 1,
            'status' => EventStatusEnum::ONGOING->value
        ])->create();
        
        $response = $this->actingAs($this->user)->get("/events/{$event->id}");
        $response->assertOk();
        // $response->assertSee($event->name);
    }

    public function test_can_delete_an_event()
    {
        $event = Event::factory([
            'event_id' => 'EVT-001',
            'name' => 'Fresh Event',
            'start_time' => now()->addDay()->format('Y-m-d H:i:s'),
            'end_time' => now()->addDays(2)->format('Y-m-d H:i:s'),
            'description' => 'Fresh description',
            'location' => 'Fresh Location',
            'organizer' => 'Fresh Organizer',
            'type' => EventTypeEnum::WEBINAR->value,
            'url' => 'https://example.com/Fresh',
            // 'image' => 'https://example.com/image2.png',
            'created_by' => 1,
            'status' => EventStatusEnum::ONGOING->value
        ])->create();

        $response = $this->actingAs($this->user)->delete("/events/{$event->id}");
        $response->assertRedirect();
        $this->assertDatabaseMissing('events', ['id' => $event->id]);
    }
}
