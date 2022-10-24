<?php

namespace Vormkracht10\GenesysApi\Entities;

use Vormkracht10\GenesysApi\Connection;
use Vormkracht10\GenesysApi\Entities\Conversations\Conversation;
use Vormkracht10\GenesysApi\Entities\Conversations\Endpoints as ConversationEndpoints;
use Vormkracht10\GenesysApi\Entities\Emails\Endpoints as EmailEndpoints;
use Vormkracht10\GenesysApi\Entities\Emails\Email;

class Model
{
    /** @param array<mixed> $attributes */
    public function __construct(
        public Connection $connection,
        public array $attributes = [],
        public array $endpoints = [],
    ) {
        // Check for Endpoints class in the same directory as the class
        $this->endpoints = $this->getEndpointClass();
    }

    public function connection(): Connection
    {
        return $this->connection;
    }

    /** @param array<string, string> $params */
    public function replaceParameters(string $endpoint, array $params = []): string
    {
        foreach ($params as $key => $value) {
            $endpoint = str_replace('{' . $key . '}', $value, $endpoint);
        }

        return $endpoint;
    }

    private function getEndpointClass(): array
    {
        $class = get_class($this);

        $endpoints = match ($class) {
            Conversation::class => $class = ConversationEndpoints::array(),
            Email::class => $class = EmailEndpoints::array(),
            default => $class = null,
        };

        if ($endpoints) {
            return $endpoints;
        }

        return [];
    }
}
