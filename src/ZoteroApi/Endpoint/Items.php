<?php

namespace ZoteroApi\Endpoint;

use ZoteroApi\Core\EndpointLogic\CanFollowCollections;
use ZoteroApi\Core\EndpointLogic\CanFollowGroupsSource;
use ZoteroApi\Core\EndpointLogic\CanFollowItems;
use ZoteroApi\Core\EndpointLogic\CanFollowPublications;
use ZoteroApi\Core\EndpointLogic\CanFollowUsersSource;

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