<?php

namespace Vormkracht10\GenesysApi\Entities\Conversations;

use Vormkracht10\GenesysApi\Entities\Model;

class Conversation extends Model
{
    public function get(string $id, array $params = []): array
    {
        $url = $this->replaceParameters(
            endpoint: Endpoints::GET,
            params: ['conversationId' => $id]
        );

        return $this->connection()->get($url, $params);
    }

    public function list(): array
    {
        $url = Endpoints::LIST;

        return $this->connection()->get($url);
    }

    public function messages(string $id): array
    {
        $url = $this->replaceParameters(
            endpoint: Endpoints::MESSAGES,
            params: ['conversationId' => $id]
        );

        return $this->connection()->get($url);
    }
}
