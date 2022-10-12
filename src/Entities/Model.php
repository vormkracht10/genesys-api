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

    public function connection()
    {
        return $this->connection;
    }

    public function replaceParameters(string $endpoint, array $parameters = []): string
    {
        foreach ($parameters as $key => $value) {
            $endpoint = str_replace('{' . $key . '}', $value, $endpoint);
        }

        return $endpoint;
    }
}
