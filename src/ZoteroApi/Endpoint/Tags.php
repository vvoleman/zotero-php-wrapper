<?php

namespace vvoleman\ZoteroApi\Endpoint;

use vvoleman\ZoteroApi\Core\EndpointLogic\CanFollowItems;
use vvoleman\ZoteroApi\Core\EndpointLogic\CanFollowTags;

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