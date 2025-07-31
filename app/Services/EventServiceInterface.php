<?php

namespace App\Services;

interface EventServiceInterface
{
    public function getAllEvents();

    public function getEventById($id);

    public function createEvent(array $data);

    public function updateEvent($id, array $data);

    public function deleteEvent($id);

    public function getLatestEvents($limit = 10);

    public function getUpcomingEvents($limit = 10);

    public function getPastEvents($limit = 10);
}
