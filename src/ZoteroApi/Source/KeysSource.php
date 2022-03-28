<?php

namespace ZoteroApi\Source;

use ZoteroApi\Core\EndpointLogic\CanFollowKeysSource;
use ZoteroApi\Endpoint\AbstractEndpoint;

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