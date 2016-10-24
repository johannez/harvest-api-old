<?php

namespace Johannez\Harvest\Resource;

use Johannez\Harvest\Connection;

class BaseResource
{
    protected $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
}