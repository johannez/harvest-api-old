<?php

namespace Johannez\Harvest;

use GuzzleHttp\Client as GuzzleClient;

class Connection
{
    protected $client;
    protected $account;
    protected $username;
    protected $password;
    protected $resources;

    public function __construct()
    {
        $this->client = null;
        $this->resources = [];
    }

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

    public function __call($name, $arguments)
    {
        $class_name = 'Johannez\\Harvest\\Resource\\' . ucfirst($name);

        if (class_exists($class_name)) {
            if (!isset($resources[$name])) {
                $resources[$name] = $class_name($this);
            }
            return $resources[$name];
        }
        else {
            throw new \Exception("Invalid reosource type given.");
        }
    }

    protected function getClient()
    {
        if (is_null($this->client)) {
            $this->client = new GuzzleClient([
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

    public function makeRequest($type, $uri, $data = null)
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