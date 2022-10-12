<?php

namespace Vormkracht10\GenesysApi\Entities\Conversations;

use Vormkracht10\GenesysApi\Entities\Model;
use Vormkracht10\GenesysApi\Traits\FindAll;

class Conversation extends Model
{
    use FindAll;

    protected array $endpoints = [
        'get' => 'conversations/{conversation}',
    ];
}
