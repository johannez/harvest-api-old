<?php

namespace HarvestApi\Traits;


Trait Client
{
    public function getClientById()
    {

    }

    public function getClients($filters = [])
    {
        $uri = 'clients';

        if ($filters) {
            $uri .= '?' . implode('&', $filters);
        }
        return $this->makeRequest('get', $uri);
    }

    public function createClient()
    {

    }

    public function updateClient() {

    }

    public function deleteClient() {

    }

    public function setClientActive($active) {}
}