<?php

namespace Vormkracht10\GenesysApi;

use Vormkracht10\GenesysApi\Entities\Conversations\Conversation;
use Vormkracht10\GenesysApi\Entities\Queues\Queue;
use Vormkracht10\GenesysApi\Entities\Users\User;

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

    /** @param array<mixed> $attributes */
    public function conversations(array $attributes = []): Conversation
    {
        return new Conversation($this->connection, $attributes);
    }

    /** @param array<mixed> $attributes */
    public function users(array $attributes = []): User
    {
        return new User($this->connection, $attributes);
    }

    /** @param array<mixed> $attributes */
    public function queues(array $attributes = []): Queue
    {
        return new Queue($this->connection, $attributes);
    }
}
