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

    public function message(string $conversationId, string $messageId): array
    {
        $url = $this->replaceParameters(
            endpoint: Endpoints::MESSAGE,
            params: [
                'conversationId' => $conversationId,
                'messageId' => $messageId,
            ]
        );

        return $this->connection()->get($url);
    }

    public function emails(string $id): array
    {
        $url = $this->replaceParameters(
            endpoint: Endpoints::EMAILS,
            params: ['conversationId' => $id]
        );

        return $this->connection()->get($url);
    }
}
