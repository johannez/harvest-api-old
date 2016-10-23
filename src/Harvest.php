<?php

namespace Johannez\HarvestApi;

use GuzzleHttp\Client;
use Johannez\HarvestApi\User;
use Johannez\HarvestApi\Timesheet;
use Johannez\HarvestApi\Project;
use Johannez\HarvestApi\Client as HarvestClient;


class Harvest
{
    use User, Timesheet, Project, HarvestClient;

    protected $client = null;
    protected $account;
    protected $username;
    protected $password;

    public function setAccount($account)
    {
        $this->account = $account;
        $this->client = null;
    }

    public function setAuth($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    protected function getClient()
    {
        if (is_null($this->client)) {
            $this->client = new Client([
                // Base URI is used with relative requests
                'base_uri' => 'https://' . $this->account . '.harvestapp.com',
                // You can set any number of default request options.
                'auth'  => [$this->username, $this->password],
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ]
            ]);
        }

        return $this->client;
    }

    protected function makeRequest($type, $uri, $data = null)
    {
        $client = $this->getClient();
        $response = null;
        $result = false;

        switch ($type) {
            case 'get':
            case 'delete':
                $response = $client->{$type}($uri);
                break;

            case 'post':
            case 'put':
                $response = $client->{$type}($uri, ['json' => $data]);
                break;
        }

        if ($response->getStatusCode() == 201 || $response->getStatusCode() == 200) {
            $result = json_decode($response->getBody());
        }

        return $result;
    }
}