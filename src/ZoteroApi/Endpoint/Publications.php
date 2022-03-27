<?php

namespace vvoleman\ZoteroApi\Endpoint;

use vvoleman\ZoteroApi\Core\EndpointLogic\CanFollowGroupsSource;
use vvoleman\ZoteroApi\Core\EndpointLogic\CanFollowUsersSource;

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
        // TODO: Implement checkEndpoint() method.
    }
}