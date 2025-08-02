<?php

namespace App\Services;

interface EventServiceInterface
{
    public function getAllEvents();

    public function getEventById($id);

    public function createEvent(array $data);

    public function updateEvent($id, array $data);

    public function deleteEvent($id);

    public function getLatestEvents($query = 'all', $limit = 15);

    public function getUpcomingEvents($limit = 15);

    public function getPastEvents($limit = 15);
}
