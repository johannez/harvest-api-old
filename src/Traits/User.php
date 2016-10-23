<?php

namespace Johannez\HarvestApi;


Trait User
{
    public function whoAmI()
    {
        $client = $this->getClient();
        $response = $client->get('account/who_am_i');
        return $this->getData($response);
    }


    public function getUsers($filters) {}
    public function getUser($id) {}
    public function createUser() {}
    public function updateUser($id) {}
    public function deleteUser($id) {}
    public function toggleUser($id) {}

    // User assignments....
}