<?php

namespace Vormkracht10\GenesysApi\Entities\Queues;

enum Endpoints
{
    public const GET = 'routing/queues/{queueId}';
    public const LIST = 'routing/queues';
    public const CREATE = 'routing/queues';
    public const UPDATE = 'routing/queues/{queueId}';
    public const DELETE = 'routing/queues/{queueId}';
    public const WRAPUP_CODES = 'routing/queues/{queueId}/wrapupcodes';
    public const MEMBERS = 'routing/queues/{queueId}/members';
}
