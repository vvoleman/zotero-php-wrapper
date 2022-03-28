<?php

namespace ZoteroApi\Source;

use ZoteroApi\Core\AbstractURLPart;
use ZoteroApi\Endpoint\AbstractEndpoint;

abstract class AbstractSource extends AbstractURLPart
{

    public function __construct(string $key) {
        parent::__construct($key);
    }

    public function getKey(): string
    {
        return $this->parameter;
    }

    public abstract function getURLName(): string;

    public abstract function canBeUsedWith(AbstractEndpoint $endpoint): bool;

}