<?php

namespace Johannez\Harvest\Resource;


class Project extends BaseResource
{
    public function getById()
    {

    }

    public function getAll($filters = [])
    {
        $uri = 'projects';

        if ($filters) {
            $uri .= '?' . implode('&', $filters);
        }
        return $this->connection->makeRequest('get', $uri);
    }

    public function create()
    {

    }

    public function update() {

    }

    public function delete() {

    }

    public function setActive($active) {}
}