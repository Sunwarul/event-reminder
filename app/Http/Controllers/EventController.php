<?php

namespace App\Http\Controllers;

use App\Enums\EventStatusEnum;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Services\EventServiceInterface;
use App\Utilities\EventIdGenerator;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{
    public function __construct(
        private EventServiceInterface $eventService,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Admin/Events/Index', [
            'events' => $this->eventService->getLatestEvents($request->query('filter')),
            'filterBy' => $request->query('filter'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Events/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $eventRequest = $request->validated();
        $eventRequest['created_by'] = auth()->id(); // Assuming you want to set
        $eventRequest['event_id'] = EventIdGenerator::generate(); // Generate a unique event ID
        $eventRequest['status'] = $eventRequest['status'] ?? EventStatusEnum::SCHEDULED; // Default status

        if ($request->hasFile('image')) {
            $eventRequest['image'] = $request->file('image')->store('events', 'public');
        }

        $event = $this->eventService->createEvent($eventRequest);

        return redirect()->route('events.show', $event->id)
            ->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return Inertia::render('Admin/Events/Show', [
            'event' => $event->load('user'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return Inertia::render('Admin/Events/Create', [
            'event' => $event,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $this->eventService->updateEvent($event->id, $request->validated());

        return redirect()->route('events.show', $event->id)
            ->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $this->eventService->deleteEvent($event->id);

        return redirect()->route('events.index')
            ->with('success', 'Event deleted successfully.');
    }

    public function removeImage(Event $event)
    {
        if ($event->image) {
            \Storage::disk('public')->delete($event->image);
            $event->image = null;
            $event->save();
        }

        return response()->json([
            'message' => 'Image removed successfully.',
        ]);
    }
}
