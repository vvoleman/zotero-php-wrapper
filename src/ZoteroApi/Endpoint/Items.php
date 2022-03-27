<?php

namespace vvoleman\ZoteroApi\Endpoint;

use vvoleman\ZoteroApi\Core\EndpointLogic\CanFollowCollections;
use vvoleman\ZoteroApi\Core\EndpointLogic\CanFollowGroupsSource;
use vvoleman\ZoteroApi\Core\EndpointLogic\CanFollowItems;
use vvoleman\ZoteroApi\Core\EndpointLogic\CanFollowPublications;
use vvoleman\ZoteroApi\Core\EndpointLogic\CanFollowUsersSource;

class Items extends AbstractEndpoint implements CanFollowCollections, CanFollowPublications, CanFollowGroupsSource,
                                                CanFollowUsersSource
{

    public const CHILDREN = "children";

    /**
     * @inheritDoc
     */
    public function getURLName(): string
    {
        return "items";
    }

    /**
     * @inheritDoc
     */
    protected function checkEndpoint(AbstractEndpoint $endpoint): bool
    {
        return $endpoint instanceof CanFollowItems && !in_array(
                $endpoint->parameter,
                [AbstractEndpoint::TRASH, AbstractEndpoint::TOP]
            );
    }
}