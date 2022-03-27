<?php

namespace vvoleman\ZoteroApi\Source;

use vvoleman\ZoteroApi\Core\EndpointLogic\CanFollowGroupsSource;
use vvoleman\ZoteroApi\Endpoint\AbstractEndpoint;

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