<?php

namespace Vormkracht10\GenesysApi\Entities\Conversations;

use Vormkracht10\GenesysApi\Entities\Model;
use Vormkracht10\GenesysApi\Traits\GetEntity;

class Conversation extends Model
{
    use GetEntity;

    protected array $endpoints = [
        'get' => 'conversations/{conversation}',
    ];
}
