<?php

use App\Models\Event;
use App\Enums\EventStatusEnum;
use App\Enums\EventTypeEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\{get, post, put, delete};

uses(RefreshDatabase::class);

describe('Event CRUD', function () {
    it('can create an event', function () {
        $data = [
            'event_id' => 'EVT-001',
            'name' => 'Test Event',
            'start_time' => now()->addDay()->format('Y-m-d H:i:s'),
            'end_time' => now()->addDays(2)->format('Y-m-d H:i:s'),
            'description' => 'A test event',
            'location' => 'Test Location',
            'organizer' => 'Test Organizer',
            'type' => EventTypeEnum::CONFERENCE->value,
            'url' => 'https://example.com',
            'image' => 'https://example.com/image.png',
            'created_by' => 'admin',
            'status' => EventStatusEnum::SCHEDULED->value,
        ];
        $response = post('/events', $data);
        $response->assertRedirect();
        $this->assertDatabaseHas('events', ['event_id' => 'EVT-001']);
    });

    it('can update an event', function () {
        $event = Event::factory()->create();
        $data = [
            'name' => 'Updated Event',
            'start_time' => now()->addDay()->format('Y-m-d H:i:s'),
            'end_time' => now()->addDays(2)->format('Y-m-d H:i:s'),
            'description' => 'Updated description',
            'location' => 'Updated Location',
            'organizer' => 'Updated Organizer',
            'type' => EventTypeEnum::WEBINAR->value,
            'url' => 'https://example.com/updated',
            'image' => 'https://example.com/image2.png',
            'created_by' => 'admin',
            'status' => EventStatusEnum::ONGOING->value,
        ];
        $response = put("/events/{$event->id}", $data);
        $response->assertRedirect();
        $this->assertDatabaseHas('events', ['id' => $event->id, 'name' => 'Updated Event']);
    });

    it('can show an event', function () {
        $event = Event::factory()->create();
        $response = get("/events/{$event->id}");
        $response->assertOk();
        $response->assertSee($event->name);
    });

    it('can delete an event', function () {
        $event = Event::factory()->create();
        $response = delete("/events/{$event->id}");
        $response->assertRedirect();
        $this->assertDatabaseMissing('events', ['id' => $event->id]);
    });
});
