<?php

namespace Vormkracht10\GenesysApi\Entities\Conversations;

use Vormkracht10\GenesysApi\Entities\Model;

class Conversation extends Model
{
    public const ENDPOINT_GET = 'conversations/{conversationId}';
    public const ENDPOINT_LIST = 'conversations';

    public function get(string $id): string
    {
        $url = $this->replaceParameters(endpoint: self::ENDPOINT_GET, params: ['conversationId' => $id]);

        return $this->connection()->get($url);
    }

    public function list(): string
    {
        $url = self::ENDPOINT_LIST;

        return $this->connection()->get($url);
    }
}
