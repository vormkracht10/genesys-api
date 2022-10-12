<?php

namespace Vormkracht10\GenesysApi\Entities\Queues;

enum Endpoints
{
    const GET = 'routing/queues/{queueId}';
    const LIST = 'routing/queues';
    const CREATE = 'routing/queues';
    const UPDATE = 'routing/queues/{queueId}';
    const DELETE = 'routing/queues/{queueId}';
    const WRAPUP_CODES = 'routing/queues/{queueId}/wrapupcodes';
}
