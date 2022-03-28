<?php

namespace ZoteroApi\Source;

use ZoteroApi\Core\EndpointLogic\CanFollowGroupsSource;
use ZoteroApi\Endpoint\AbstractEndpoint;

class GroupsSource extends AbstractSource
{

    public function getURLName(): string
    {
        return "groups";
    }

    public function canBeUsedWith(AbstractEndpoint $endpoint): bool
    {
        return $endpoint instanceof CanFollowGroupsSource;
    }
}