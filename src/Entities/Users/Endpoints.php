<?php

namespace Vormkracht10\GenesysApi\Entities\Users;

enum Endpoints
{
    public const GET = 'users/{userId}';
    public const LIST = 'users';
    public const CREATE = 'users';
    public const UPDATE = 'users/{userId}';
    public const DELETE = 'users/{userId}';
    public const QUEUES = 'users/{userId}/queues';
}
