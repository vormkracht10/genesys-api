<?php

namespace Vormkracht10\GenesysApi\Entities\Queues;

use Vormkracht10\GenesysApi\Entities\Model;

class Queue extends Model
{
    public function get(string $id, array $params = []): array
    {
        $url = $this->replaceParameters(
            endpoint: Endpoints::GET,
            params: ['queueId' => $id]
        );

        return $this->connection()->get($url, $params);
    }

    public function list(array $params = []): array
    {
        $url = Endpoints::LIST;

        return $this->connection()->get($url, $params);
    }

    public function create(array $params): array
    {
        $url = Endpoints::CREATE;

        return $this->connection()->post($url, $params);
    }

    public function update(string $id, array $params): array
    {
        $url = $this->replaceParameters(
            endpoint: Endpoints::UPDATE,
            params: ['queueId' => $id]
        );

        return $this->connection()->put($url, $params);
    }

    public function delete(string $id): array
    {
        $url = $this->replaceParameters(
            endpoint: Endpoints::DELETE,
            params: ['queueId' => $id]
        );

        return $this->connection()->delete($url);
    }

    public function getWrapupCodes(string $id, array $params = []): array
    {
        $url = $this->replaceParameters(
            endpoint: Endpoints::GET_WRAPUP_CODES,
            params: ['queueId' => $id]
        );

        return $this->connection()->get($url, $params);
    }

    public function members(string $id, array $params = []): array
    {
        $url = $this->replaceParameters(
            endpoint: Endpoints::MEMBERS,
            params: ['queueId' => $id]
        );

        return $this->connection()->get($url, $params);
    }
}
