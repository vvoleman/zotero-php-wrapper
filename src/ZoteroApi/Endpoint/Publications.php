<?php

namespace ZoteroApi\Endpoint;

use ZoteroApi\Core\EndpointLogic\CanFollowGroupsSource;
use ZoteroApi\Core\EndpointLogic\CanFollowPublications;
use ZoteroApi\Core\EndpointLogic\CanFollowUsersSource;

class Publications extends AbstractEndpoint implements CanFollowGroupsSource, CanFollowUsersSource
{

    /**
     * @inheritDoc
     */
    public function getURLName(): string
    {
        return "publications";
    }

    /**
     * @inheritDoc
     */
    protected function checkEndpoint(AbstractEndpoint $endpoint): bool
    {
        return $endpoint instanceof CanFollowPublications;
    }
}