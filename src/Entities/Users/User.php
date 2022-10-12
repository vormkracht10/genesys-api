<?php

namespace Vormkracht10\GenesysApi\Entities\Users;

use Vormkracht10\GenesysApi\Entities\Model;

class User extends Model
{
    public const ENDPOINT_GET = 'users/{userId}';
    public const ENDPOINT_LIST = 'users';

    public function get(string $id, array $params = []): string
    {
        $url = $this->replaceParameters(
            endpoint: self::ENDPOINT_GET, 
            params: ['userId' => $id
        ]);

        return $this->connection()->get($url, $params);
    }

    public function list(): string
    {
        $url = self::ENDPOINT_LIST;

        return $this->connection()->get($url);
    }
}
