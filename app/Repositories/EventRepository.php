<?php

namespace App\Repositories;

use App\Enums\EventStatusEnum;

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

    public function getLatestEvents($query = 'all', $limit = 15)
    {
        return match($query) {
            'all' => $this->model->paginate($limit),
            'ongoing' => $this->model->where('status', EventStatusEnum::ONGOING)->paginate($limit),
            'scheduled' => $this->model->where('status', EventStatusEnum::SCHEDULED)->paginate($limit),
            'completed' => $this->model->where('status', EventStatusEnum::COMPLETE)->paginate($limit),
            default => $this->model->paginate($limit),
        };
    }

    public function getUpcomingEvents($limit = 15)
    {
        return $this->model->where('status', 'Scheduled')->orderBy('start_time')->paginate($limit);
    }

    public function getPastEvents($limit = 15)
    {
        return $this->model->where('status', 'Complete')->orderBy('end_time', 'desc')->paginate($limit);
    }

    public function getEventsByUserId($userId)
    {
        return $this->model->where('user_id', $userId)->get();
    }
}
