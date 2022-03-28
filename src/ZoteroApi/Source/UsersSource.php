<?php

namespace ZoteroApi\Source;

use ZoteroApi\Core\EndpointLogic\CanFollowGroupsSource;
use ZoteroApi\Endpoint\AbstractEndpoint;

class UsersSource extends AbstractSource
{
    public function getURLName(): string
    {
        return "users";
    }

    public function canBeUsedWith(AbstractEndpoint $endpoint): bool
    {
        return $endpoint instanceof CanFollowGroupsSource;
    }

}