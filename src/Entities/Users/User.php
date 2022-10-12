<?php

namespace Vormkracht10\GenesysApi\Entities\Users;

use Vormkracht10\GenesysApi\Entities\Model;

class User extends Model
{
    public const ENDPOINT_GET = 'users/{userId}';
    public const ENDPOINT_LIST = 'users';
    public const ENDPOINT_CREATE = 'users';
    public const ENDPOINT_DELETE = 'users/{userId}';

    public function get(string $id, array $params = []): string
    {
        $url = $this->replaceParameters(
            endpoint: self::ENDPOINT_GET,
            params: ['userId' => $id,
        ]
        );

        return $this->connection()->get($url, $params);
    }

    public function list(): string
    {
        $url = self::ENDPOINT_LIST;

        return $this->connection()->get($url);
    }

    public function create(array $params): string
    {
        $url = self::ENDPOINT_CREATE;

        $params = ['body' => json_encode($params)];

        return $this->connection()->post($url, $params);
    }

    public function delete(string $id): string
    {
        $url = $this->replaceParameters(
            endpoint: self::ENDPOINT_DELETE,
            params: ['userId' => $id,
        ]
        );

        return $this->connection()->delete($url);
    }
}
