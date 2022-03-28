<?php

namespace ZoteroApi\Endpoint;

use ZoteroApi\Core\EndpointLogic\CanFollowItems;
use ZoteroApi\Core\EndpointLogic\CanFollowTags;

class Tags extends AbstractEndpoint implements CanFollowItems
{

    /**
     * @inheritDoc
     */
    public function getURLName(): string
    {
        return "tags";
    }

    /**
     * @inheritDoc
     */
    protected function checkEndpoint(AbstractEndpoint $endpoint): bool
    {
        return $endpoint instanceof CanFollowTags;
    }
}