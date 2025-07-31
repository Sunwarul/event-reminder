<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Services\EventServiceInterface;
use Inertia\Inertia;

class EventController extends Controller
{
    public function __construct(
        private EventServiceInterface $eventService,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/Events/Index', [
            'events' => $this->eventService->getAllEvents(),
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
        $event = $this->eventService->createEvent($request->validated());
        return redirect()->route('events.show', $event->id)
            ->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return Inertia::render('Admin/Events/Show', [
            'event' => $event,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return Inertia::render('Admin/Events/Edit', [
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
}
