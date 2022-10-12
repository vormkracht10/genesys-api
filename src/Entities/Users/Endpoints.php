<?php 

namespace Vormkracht10\GenesysApi\Entities\Users;

enum Endpoints 
{
    const GET = 'users/{userId}';
    const LIST = 'users';
    const CREATE = 'users';
    const UPDATE = 'users/{userId}';
    const DELETE = 'users/{userId}';
}