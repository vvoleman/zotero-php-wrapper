<?php

namespace ZoteroApi\Endpoint;

use ZoteroApi\Core\EndpointLogic\CanFollowCollections;
use ZoteroApi\Core\EndpointLogic\CanFollowGroupsSource;
use ZoteroApi\Core\EndpointLogic\CanFollowUsersSource;

class Collections extends AbstractEndpoint implements CanFollowCollections, CanFollowGroupsSource, CanFollowUsersSource
{

    /**
     * @inheritDoc
     */
    public function getURLName(): string
    {
        return "collections";
    }

    /**
     * @inheritDoc
     *
     */
    protected function checkEndpoint(AbstractEndpoint $endpoint): bool
    {
        return ($endpoint instanceof CanFollowCollections && !in_array($this->parameter,[self::ALL,self::TOP,self::TRASH]));
    }
}