<?php

namespace Johannez\Harvest\Resource;


class Project
{
    public function getProjectById()
    {

    }

    public function getProjects($filters = [])
    {
        $uri = 'projects';

        if ($filters) {
            $uri .= '?' . implode('&', $filters);
        }
        return $this->makeRequest('get', $uri);
    }

    public function createProject()
    {

    }

    public function updateProject() {

    }

    public function deleteProject() {

    }

    public function setProjectActive($active) {}
}