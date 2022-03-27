<?php

namespace vvoleman\ZoteroApi\Core;

abstract class AbstractURLPart
{

    protected string $parameter;

    public function __construct(string $parameter)
    {
        $this->parameter = $parameter;
    }

    public abstract function getURLName(): string;

    public function __toString(): string
    {
        return sprintf("/%s%s",$this->getURLName(),(!empty($this->parameter)) ? "/".$this->parameter : "");
    }

}