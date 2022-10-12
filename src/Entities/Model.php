<?php

namespace Vormkracht10\GenesysApi\Entities;

use Vormkracht10\GenesysApi\Connection;

class Model
{
    public function __construct(Connection $connection, array $attributes = [])
    {
        $this->connection = $connection;
        $this->attributes = $attributes;
    }

    public function getEndpoint(string $endpoint): string
    {
        return $this->endpoints[$endpoint];
    }

    public function connection()
    {
        return $this->connection;
    }
}
