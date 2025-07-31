<?php

namespace App\Repositories;

interface EventRepositoryInterface
{
    public function paginate($perPage = 15);

    public function all();

    public function find($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);

    public function getLatestEvents($limit = 10);

    public function getUpcomingEvents($limit = 10);

    public function getPastEvents($limit = 10);
}
