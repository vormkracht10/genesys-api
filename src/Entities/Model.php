<?php

namespace Vormkracht10\GenesysApi\Entities;

use Vormkracht10\GenesysApi\Connection;

/**
 * @property Connection $connection
 * @property array $attributes
 */
class Model
{
    /** @param array<mixed> $attributes */
    public function __construct(
        public Connection $connection,
        public array $attributes = []
    ) {
    }

    public function connection(): Connection
    {
        return $this->connection;
    }

    /** @param array<string, string> $params */
    public function replaceParameters(string $endpoint, array $params = []): string
    {
        foreach ($params as $key => $value) {
            $endpoint = str_replace('{' . $key . '}', $value, $endpoint);
        }

        return $endpoint;
    }
}
