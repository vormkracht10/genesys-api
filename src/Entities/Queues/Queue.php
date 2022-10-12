<?php

namespace Vormkracht10\GenesysApi\Entities\Queues;

use Vormkracht10\GenesysApi\Entities\Model;

class Queue extends Model
{
    public const ENDPOINT_GET = 'routing/queues/{queueId}';
    public const ENDPOINT_LIST = 'routing/queues';
    public const ENDPOINT_CREATE = 'routing/queues';
    public const ENDPOINT_UPDATE = 'routing/queues/{queueId}';
    public const ENDPOINT_DELETE = 'routing/queues/{queueId}';

    public function get(string $id, array $params = []): array
    {
        $url = $this->replaceParameters(
            endpoint: self::ENDPOINT_GET,
            params: ['queueId' => $id]
        );

        return $this->connection()->get($url, $params);
    }
    public function list(array $params = []): array
    {
        $url = self::ENDPOINT_LIST;

        return $this->connection()->get($url, $params);
    }

    public function create(array $params): array
    {
        $url = self::ENDPOINT_CREATE;

        $params = ['body' => json_encode($params)];

        return $this->connection()->post($url, $params);
    }

    public function update(string $id, array $params): array
    {
        $url = $this->replaceParameters(
            endpoint: self::ENDPOINT_UPDATE,
            params: ['queueId' => $id]
        );

        $params = ['body' => json_encode($params)];

        return $this->connection()->put($url, $params);
    }

    public function delete(string $id): array
    {
        $url = $this->replaceParameters(
            endpoint: self::ENDPOINT_DELETE,
            params: ['queueId' => $id]
        );

        return $this->connection()->delete($url);
    }
}
