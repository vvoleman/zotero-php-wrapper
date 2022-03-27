<?php

namespace vvoleman\ZoteroApi\Source;

use vvoleman\ZoteroApi\Core\EndpointLogic\CanFollowKeysSource;
use vvoleman\ZoteroApi\Endpoint\AbstractEndpoint;

class KeysSource extends AbstractSource
{

    public function getURLName(): string
    {
        return "keys";
    }

    public function canBeUsedWith(AbstractEndpoint $endpoint): bool
    {
        return $endpoint instanceof CanFollowKeysSource;
    }
}