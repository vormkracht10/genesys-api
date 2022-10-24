<?php

namespace Vormkracht10\GenesysApi\Entities\Emails;

use Vormkracht10\GenesysApi\Traits\EnumsToArray;

enum Endpoints: string
{
    use EnumsToArray;

    case GET = 'conversations/emails/{conversationId}';
}
