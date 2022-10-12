<?php

namespace Vormkracht10\GenesysApi\Entities\Users;

use Vormkracht10\GenesysApi\Entities\Model;

class User extends Model
{
    public const ENDPOINT_GET = 'users/{userId}';
    public const ENDPOINT_LIST = 'users';
    public const ENDPOINT_CREATE = 'users';
    public const ENDPOINT_DELETE = 'users/{userId}';

    public function get(string $id, array $params = []): array
    {
        $url = $this->replaceParameters(
            endpoint: self::ENDPOINT_GET,
            params: ['userId' => $id]
        );

        return $this->connection()->get($url, $params);
    }

    public function list(): array
    {
        $url = self::ENDPOINT_LIST;

        return $this->connection()->get($url);
    }

    public function create(array $params): array
    {
        $url = self::ENDPOINT_CREATE;

        $params = ['body' => json_encode($params)];

        return $this->connection()->post($url, $params);
    }

    public function update(string $id, array $params): array
    {
        // It's required to get the version of the user before updating it.
        $version = $this->get($id)['version'];

        $url = $this->replaceParameters(
            endpoint: self::ENDPOINT_GET,
            params: ['userId' => $id]
        );

        $params['version'] = $version;
    
        $params = ['body' => json_encode($params)];

        return $this->connection()->put($url, $params);
    }

    public function delete(string $id): array
    {
        $url = $this->replaceParameters(
            endpoint: self::ENDPOINT_DELETE,
            params: ['userId' => $id]
        );

        return $this->connection()->delete($url);
    }
}
