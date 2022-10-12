<?php

namespace Vormkracht10\GenesysApi\Entities\Queues;

use Vormkracht10\GenesysApi\Entities\Model;

class Queue extends Model
{
    public const ENDPOINT_LIST = 'routing/queues';

    public function list(array $params = []): array
    {
        $url = self::ENDPOINT_LIST;

        return $this->connection()->get($url, $params);
    }
}
