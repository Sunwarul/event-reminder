<?php

namespace App\Services;

use App\Repositories\EventRepositoryInterface;

class EventService implements EventServiceInterface
{
    protected $eventRepository;

    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function getAllEvents($query = null)
    {
        return $this->eventRepository->paginate();
    }

    public function getEventById($id)
    {
        return $this->eventRepository->find($id);
    }

    public function createEvent(array $data)
    {
        return $this->eventRepository->create($data);
    }

    public function updateEvent($id, array $data)
    {
        return $this->eventRepository->update($id, $data);
    }

    public function deleteEvent($id)
    {
        return $this->eventRepository->delete($id);
    }

    public function getLatestEvents($query = 'all', $limit = 15)
    {
        return $this->eventRepository->getLatestEvents($query, $limit);
    }

    public function getUpcomingEvents($limit = 15)
    {
        return $this->eventRepository->getUpcomingEvents($limit);
    }

    public function getPastEvents($limit = 15)
    {
        return $this->eventRepository->getPastEvents($limit);
    }

    public function getEventsByUserId($userId)
    {
        return $this->eventRepository->getEventsByUserId($userId);
    }
}
