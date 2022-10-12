<?php

namespace Vormkracht10\GenesysApi\Entities\Queues;

use Vormkracht10\GenesysApi\Entities\Model;

class Queue extends Model
{
    public const ENDPOINT_GET = 'routing/queues/{queueId}';
    public const ENDPOINT_LIST = 'routing/queues';
    public const ENDPOINT_CREATE = 'routing/queues';

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


}
