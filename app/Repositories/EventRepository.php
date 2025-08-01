<?php

namespace App\Repositories;

class EventRepository implements EventRepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->model = new \App\Models\Event;
    }

    public function paginate($perPage = 15)
    {
        return $this->model->paginate($perPage);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $event = $this->find($id);
        $event->update($data);

        return $event;
    }

    public function delete($id)
    {
        $event = $this->find($id);

        return $event->delete();
    }

    public function getLatestEvents($limit = 10)
    {
        return $this->model->latest()->paginate($limit);
    }

    public function getUpcomingEvents($limit = 10)
    {
        return $this->model->where('date', '>', now())->orderBy('date')->take($limit)->get();
    }

    public function getPastEvents($limit = 10)
    {
        return $this->model->where('date', '<', now())->orderBy('date', 'desc')->take($limit)->get();
    }

    public function getEventsByUserId($userId)
    {
        return $this->model->where('user_id', $userId)->get();
    }
}
