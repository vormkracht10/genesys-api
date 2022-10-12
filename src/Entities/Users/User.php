<?php

namespace Vormkracht10\GenesysApi\Entities\Users;

use Vormkracht10\GenesysApi\Entities\Model;
use Vormkracht10\GenesysApi\Entities\Users\Endpoints;

class User extends Model
{
    public function get(string $id, array $params = []): array
    {
        $url = $this->replaceParameters(
            endpoint: Endpoints::GET,
            params: ['userId' => $id]
        );

        return $this->connection()->get($url, $params);
    }

    public function list(): array
    {
        $url = Endpoints::LIST;

        return $this->connection()->get($url);
    }

    public function create(array $params): array
    {
        $url = Endpoints::CREATE;

        $params = ['body' => json_encode($params)];

        return $this->connection()->post($url, $params);
    }

    public function update(string $id, array $params): array
    {
        // It's required to get the version of the user before updating it.
        $version = $this->get($id)['version'];

        $url = $this->replaceParameters(
            endpoint: Endpoints::UPDATE,
            params: ['userId' => $id]
        );

        $params['version'] = $version;

        $params = ['body' => json_encode($params)];

        return $this->connection()->patch($url, $params);
    }

    public function delete(string $id): array
    {
        $url = $this->replaceParameters(
            endpoint: Endpoints::DELETE,
            params: ['userId' => $id]
        );

        return $this->connection()->delete($url);
    }
}
