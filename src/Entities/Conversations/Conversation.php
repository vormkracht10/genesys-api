<?php

namespace Vormkracht10\GenesysApi\Entities\Conversations;

use Vormkracht10\GenesysApi\Entities\Model;
use Vormkracht10\GenesysApi\Entities\Conversations\Endpoints;

class Conversation extends Model
{
    public function get(string $id, array $params = []): string
    {
        $url = $this->replaceParameters(
            endpoint: Endpoints::GET,
            params: ['conversationId' => $id]
        );

        return $this->connection()->get($url, $params);
    }

    public function list(): string
    {
        $url = Endpoints::LIST;

        return $this->connection()->get($url);
    }
}
