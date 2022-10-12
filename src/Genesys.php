<?php

namespace Vormkracht10\GenesysApi;

use Vormkracht10\GenesysApi\Entities\Conversations\Conversation;

class Genesys
{
    protected string $accessToken;

    protected Connection $connection;

    public function __construct(string $accessToken, string|null $region = null)
    {
        $this->accessToken = $accessToken;
        $this->connection = new Connection(accessToken: $accessToken, region: $region);
    }

    public static function api(string $accessToken, string|null $region = null): Genesys
    {
        return new Genesys(accessToken: $accessToken, region: $region);
    }

    public function conversation(array $attributes = []): Conversation
    {
        return new Conversation($this->connection, $attributes);
    }
}
