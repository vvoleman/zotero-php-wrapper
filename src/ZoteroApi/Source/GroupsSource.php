<?php

namespace vvoleman\ZoteroApi\Source;

use vvoleman\ZoteroApi\Core\EndpointLogic\CanFollowGroupsSource;
use vvoleman\ZoteroApi\Endpoint\AbstractEndpoint;

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